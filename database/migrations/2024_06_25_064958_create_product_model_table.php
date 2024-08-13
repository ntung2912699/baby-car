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
        Schema::create('product_model', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producer_id');
            $table->string('name')
                ->unique()
                ->nullable('false');
            $table->timestamps();

            $table->foreign('producer_id')
                ->references('id')
                ->on('producer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_model');
    }
};
