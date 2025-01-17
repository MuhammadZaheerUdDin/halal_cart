<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
        /**
     * Fillable columns.
     *
     * @var string[]
     */
    protected $fillable = ['user_id'];

    /**
     * The relations to eager load on every query.
     *
     * @var string[]
     */
    protected $with = ['items'];
    // Relations

    /**
     * Relation one-to-many, CartItem model.
     */
    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Product::class,'itemable_id');
    }

    // Scopes

    /**
     * @throws \Exception
     */
    public function scopeFirstOrCreateWithStoreItems(
        Builder $query,
        Model $item,
        string $variant_metadata,
        int $variant_id,
        int $quantity = 1,
        string $price,
        string $total,
        ?int $user_id = null
    ): Builder 
    {
        if (is_null($user_id)) {
            $user_id = auth()->id();
        }
        // dd($variant_id);
        // if (! $item instanceof Cartable) {
        //     throw new \Exception('The item must be an instance of Cartable');
        // }
        $cart = $query->firstOrCreate(['user_id' => $user_id]);
        $existingCartItem = $cart->items()->where('itemable_id', $item->getKey())
        ->where('itemable_type', $item::class)
        ->where('variant_id', $variant_id)
        ->first();
        if ($existingCartItem) {
            // Increase the quantity of the existing item
            $existingCartItem->increment('quantity', $quantity);
        } else {
            // Create a new cart item if it doesn't exist
            $cartItem = new CartItem([
                'itemable_id' => $item->getKey(),
                'itemable_type' => $item::class,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $total,
                'variant_metadata' => $variant_metadata,
                'variant_id' => $variant_id
            ]);
            $cart->items()->save($cartItem);
        }

        // Dispatch Event
        // LaravelCartStoreItemEvent::dispatch();

        return $query;
    }

    // Methods

    /**
     * Calculate price by quantity of items.
     */
    public function calculatedPriceByQuantity(): int
    {
        $totalPrice = 0;
        foreach ($this->items()->get() as $item) {
            $totalPrice += (int) $item->quantity * (int) $item->itemable->getPrice();
        }

        return $totalPrice;
    }

    /**
     * Store multiple items in cart.
     */
    public function storeItems(array $items): static
    {
        foreach ($items as $item) {
            $this->storeItem($item);
        }

        return $this;
    }

    /**
     * Store cart item in cart.
     */
    public function storeItem(Model|array $item): static
    {
        if (is_array($item)) {
            $item['itemable_id'] = $item['itemable']->getKey();
            $item['itemable_type'] = get_class($item['itemable']);
            $item['quantity'] = (int) $item['quantity'];

            // if ($item['itemable'] instanceof Cartable) {
            $this->items()->create($item);
            // } else {
            //     throw new \RuntimeException(sprintf('The item must be an instance of %s', Cartable::class));
            // }
        } else {
            // if ($item instanceof Cartable) {
                $this->items()->create([
                    'itemable_id' => $item->getKey(),
                    'itemable_type' => get_class($item),
                    'itemable_quantity' => 1,
                ]);
            // } else {
            //     throw new \RuntimeException(sprintf('The item must be an instance of %s', Cartable::class));
            // }
        }

        // Dispatch Event
        // LaravelCartStoreItemEvent::dispatch();

        return $this;
    }

    /**
     * Remove a single item from the cart
     */
    public function removeItem(Model $item): static
    {
        $itemToDelete = $this->items()->find($item->getKey());

        if ($itemToDelete) {
            $itemToDelete->delete();
        }

        // Dispatch Event
        // LaravelCartRemoveItemEvent::dispatch();

        return $this;
    }

    /**
     * Remove every item from the cart
     */
    public function emptyCart(): static
    {
        $this->items()->delete();

        // Dispatch Event
        // LaravelCartEmptyEvent::dispatch();

        return $this;
    }

    /**
     * Increase the quantity of the item.
     */
    public function increaseQuantity(Model $item, int $quantity = 1): static
    {
        $item = $this->items()->firstWhere('itemable_id', $item->getKey());
        if (! $item) {
            throw new \RuntimeException('The item not found');
        }

        $item->increment('quantity', $quantity);

        // Dispatch Event
        // LaravelCartIncreaseQuantityEvent::dispatch($item);

        return $this;
    }

    /**
     * Decrease the quantity of the item.
     */
    public function decreaseQuantity(Model $item, int $quantity = 1): static
    {
        $item = $this->items()->find($item->getKey());
        if (! $item) {
            throw new \RuntimeException('The item not found');
        }

        $item->decrement('quantity', $quantity);

        // Dispatch Event
        // LaravelCartDecreaseQuantityEvent::dispatch($item);

        return $this;
    }
}
