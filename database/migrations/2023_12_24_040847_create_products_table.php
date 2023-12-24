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
            // description
            $table->text('description')->nullable();
            // price product
            $table->integer('price')->default(0);
            // image
            $table->string('image')->nullable();
            // category foreign key from categories table
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            // stock 
            $table->integer('stock')->default(0);
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
