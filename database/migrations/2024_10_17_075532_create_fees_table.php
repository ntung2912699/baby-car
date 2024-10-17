<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->integer('fee_mode');
            $table->string('fee_type'); // Loại phí (trước bạ, biển số, bảo hiểm dân sự, đăng kiểm, bảo trì đường bộ, v.v.)
            $table->float('fee_value')->default(0); // Giá trị của phí (tính theo % hoặc giá cố định)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
