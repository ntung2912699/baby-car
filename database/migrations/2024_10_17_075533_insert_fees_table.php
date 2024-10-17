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
        // Thực hiện các câu lệnh INSERT
        DB::statement("
            INSERT INTO `fees` (`id`, `fee_mode`, `fee_type`, `fee_value`, `created_at`, `updated_at`) 
            VALUES ('1', 3, 'Phí Trước Bạ', '0', NOW(), NOW())
        ");
        DB::statement("
            INSERT INTO `fees` (`id`, `fee_mode`, `fee_type`, `fee_value`, `created_at`, `updated_at`) 
            VALUES ('2', 0, 'Phí Bảo Hiểm Dân Sự', '437000', NOW(), NOW())
        ");
        DB::statement("
            INSERT INTO `fees` (`id`, `fee_mode`, `fee_type`, `fee_value`, `created_at`, `updated_at`) 
            VALUES ('3', 0, 'Phí Bảo Trì Đường Bộ', '1560000', NOW(), NOW())
        ");
        DB::statement("
            INSERT INTO `fees` (`id`, `fee_mode`, `fee_type`, `fee_value`, `created_at`, `updated_at`) 
            VALUES ('4', 0, 'Phí Đăng Kiểm', '240000', NOW(), NOW())
        ");
        DB::statement("
            INSERT INTO `fees` (`id`, `fee_mode`, `fee_type`, `fee_value`, `created_at`, `updated_at`) 
            VALUES ('5', 1, 'Phí Đổi Biển Số', '500000', NOW(), NOW())
        ");
        DB::statement("
            INSERT INTO `fees` (`id`, `fee_mode`, `fee_type`, `fee_value`, `created_at`, `updated_at`) 
            VALUES ('6', 2, 'Phí Đổi Biển Số', '20000000', NOW(), NOW())
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Xoá dữ liệu đã thêm trong hàm up()
        DB::statement("DELETE FROM `fees` WHERE `id` IN ('1', '2', '3', '4', '5', '6')");
    }
};
