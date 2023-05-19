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
        Schema::create('tbl_attendance', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->integer('user_id')->nullable();
            $table->string('attendance_date', 50)->nullable();
            $table->string('attendance', 50)->nullable();
            $table->string('reason', 100)->nullable();
            $table->string('time_in', 50)->nullable();
            $table->string('time_out', 50)->nullable();
            $table->string('worked_hrs', 50)->nullable();
            $table->string('timesheet_log_hrs', 100)->nullable();
            $table->string('remote_in', 50)->nullable();
            $table->string('remote_out', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_attendance');
    }
};
