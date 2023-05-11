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
        Schema::create('tbl_source', function (Blueprint $table) {
            $table->integer('source_id')->autoIncrement();
            $table->string('source_name', 100)->nullable();
            $table->enum('source_status', ['1', '0'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_source');
    }
};
