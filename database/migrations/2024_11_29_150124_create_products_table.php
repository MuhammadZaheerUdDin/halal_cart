<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('price');
            $table->integer('stock');
            $table->string('sku')->unique();
            $table->string('image')->nullable();
            $table->integer('category_id');
            $table->json('subcategory_id');//->nullable();
            $table->tinyInteger('stock_status')->default(true);
            $table->tinyInteger('status')->default(true);
            //new lines added
            $table->string('code')->nullable();
            $table->string('slug');
            $table->integer('brand_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->tinyInteger('featured')->default(false);
            $table->tinyInteger('hot')->default(false);
            $table->tinyInteger('best')->default(false);
            $table->tinyInteger('top')->default(false);
            $table->tinyInteger('latest')->default(false);
            $table->tinyInteger('big')->default(false);
            $table->tinyInteger('trending')->default(false);
            $table->tinyInteger('sale')->default(false);
            $table->tinyInteger('is_discount')->default(false);
            $table->tinyInteger('discount_amount')->default(false);
            $table->date('discount_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
