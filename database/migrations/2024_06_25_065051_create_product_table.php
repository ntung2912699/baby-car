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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('producer_id');
            $table->unsignedBigInteger('status_id');
            $table->string('name')->nullable('false');
            $table->string('price');
            $table->string('thumbnail');
            $table->text('gallery');
            $table->text('description');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('category');
            $table->foreign('producer_id')
                ->references('id')
                ->on('producer');
            $table->foreign('status_id')
                ->references('id')
                ->on('product_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
