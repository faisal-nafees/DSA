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
        Schema::create('tbl_contacts', function (Blueprint $table) {
            $table->integer('contact_id')->autoIncrement();
            $table->string('fullname', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('mobile', 200)->nullable();
            $table->string('subject', 200)->nullable();
            $table->text('message')->nullable();
            $table->enum('source_status', ['1', '0'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_contacts');
    }
};
