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
        Schema::create('tbl_leaves', function (Blueprint $table) {
            $table->id('leave_id');
            $table->integer('user_id')->nullable();
            $table->integer('type')->nullable();
            $table->string('subject')->nullable();
            $table->text('reason')->nullable();
            $table->string('leave_start')->nullable();
            $table->string('leave_end')->nullable();
            $table->integer('leave_status')->nullable();
            $table->integer('update_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_leaves');
    }
};
