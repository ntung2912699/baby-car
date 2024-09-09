<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) 
            VALUES ('1', 'USER', NOW(), NOW())
        ");
        DB::statement("
            INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) 
            VALUES ('11', 'ADMIN', NOW(), NOW())
        ");
        DB::statement("
            INSERT INTO `users`(`id`, `name`, `email`, `email_verified_at`, `password`, `roles_id`, `remember_token`, `created_at`, `updated_at`, `facebook_id`, `facebook_token`, `facebook_refresh_token`, `google_id`, `avatar`, `otp`, `otp_expiry`) 
            VALUES ('11','Admin BabyCar','ntung9921@gmail.com',NULL,'$2y$12$5t12q7G8inkSDtmYrhWMp.n7bdZ03hsKhak4DRcOnB0jwo6fudx/W','1',NULL,NOW(),NOW(),NULL,NULL,NULL,NULL,NULL,NULL,NULL)
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
        DB::statement("DELETE FROM `users` WHERE `id` = '1'");
        DB::statement("DELETE FROM `user_roles` WHERE `id` IN ('1', '11')");
    }
};
