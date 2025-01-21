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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id'); // Foreign key for categories
            $table->string('name'); // Subcategory name
            $table->string('slug'); // Subcategory slug
            $table->string('image')->nullable(); // Subcategory slug
            $table->text('description')->nullable(); // Optional description
            $table->text('position')->nullable(); // Optional description
            $table->integer('status')->default('1'); // Foreign key for categories
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
