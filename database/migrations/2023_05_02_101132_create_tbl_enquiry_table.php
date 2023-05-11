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
        Schema::create('tbl_enquiry', function (Blueprint $table) {
            $table->integer('enq_id')->autoIncrement();
            $table->integer('enq_type')->nullable();
            $table->integer('enq_source')->nullable();
            $table->string('fullname', 200)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('mobile', 13)->nullable();
            $table->string('whatsapp', 13)->nullable();
            $table->string('city', 10)->nullable();
            $table->text('address')->nullable();
            $table->integer('created_user')->nullable();
            $table->integer('updated_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_enquiry');
    }
};