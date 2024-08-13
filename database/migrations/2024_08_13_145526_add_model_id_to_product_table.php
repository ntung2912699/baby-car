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
        Schema::table('product', function (Blueprint $table) {
            // Thêm cột model_id
            $table->unsignedBigInteger('model_id')->after('producer_id');

            // Thêm khóa ngoại
            $table->foreign('model_id')
                ->references('id')
                ->on('product_model'); // Hoặc onDelete('set null') nếu bạn muốn set giá trị là null khi bản ghi bị xóa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            // Xóa khóa ngoại
            $table->dropForeign(['model_id']);

            // Xóa cột model_id
            $table->dropColumn('model_id');
        });
    }
};
