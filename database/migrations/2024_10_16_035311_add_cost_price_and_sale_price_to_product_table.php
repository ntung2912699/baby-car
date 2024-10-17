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
        Schema::table('product', function (Blueprint $table) {
            // Thêm cột giá nhập và giá bán
            $table->string('cost_price')->after('price'); // Giá nhập
            $table->string('sale_price')->after('cost_price'); // Giá bán
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            // Xóa cột nếu rollback
            $table->dropColumn('cost_price');
            $table->dropColumn('sale_price');
        });
    }
};
