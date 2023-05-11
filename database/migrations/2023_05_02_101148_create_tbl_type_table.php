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
        Schema::create('tbl_type', function (Blueprint $table) {
            $table->integer('enqtype_id')->autoIncrement();
            $table->string('enqtype_name', 200)->nullable();
            $table->enum('enqtype_status', ['1', '0'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_type');
    }
};
