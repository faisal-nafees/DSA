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
        Schema::create('tbl_reporting', function (Blueprint $table) {
            $table->id('reporting_id');
            $table->integer('task_id')->nullable();
            $table->integer('report_status_id')->nullable();
            $table->text('report_description')->nullable();
            $table->string('remark', 255)->nullable();
            $table->string('report_date', 50)->nullable();
            $table->string('start_task', 50)->nullable();
            $table->string('end_task', 50)->nullable();
            $table->string('attachment', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_reporting');
    }
};
