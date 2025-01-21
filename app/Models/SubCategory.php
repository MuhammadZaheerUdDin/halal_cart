<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    /** @use HasFactory<\Database\Factories\SubCategoryFactory> */
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'position', 'image'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cat) {
            $cat->slug = Str::slug($cat->name);

            // Ensure uniqueness if needed
            $count = static::where('slug', 'LIKE', "{$cat->slug}%")->count();
            if ($count > 0) {
                $cat->slug .= '-' . ($count + 1);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
