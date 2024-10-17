<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên người dùng
            $table->string('phone'); // Số điện thoại
            $table->unsignedBigInteger('product_id'); // Số điện thoại
            $table->string('status'); // Số điện thoại
            $table->text('note'); // Số điện thoại
            $table->timestamps(); // Thời gian tạo và cập nhật
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_requests');
    }
};
