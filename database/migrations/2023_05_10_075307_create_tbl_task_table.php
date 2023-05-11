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
        Schema::create('tbl_task', function (Blueprint $table) {
            $table->id('task_id');
            $table->integer('user_id')->nullable();
            $table->string('title', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('assigned_date', 100)->nullable();
            $table->string('assigned_time', 100)->nullable();
            $table->string('estimate_date', 100)->nullable();
            $table->string('estimate_time', 100)->nullable();
            $table->string('attachment', 255)->nullable();
            $table->string('attachment', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_task');
    }
};