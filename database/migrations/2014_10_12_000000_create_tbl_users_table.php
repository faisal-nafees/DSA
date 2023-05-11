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
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('role_id')->nullable();
            $table->string('firstname', 200)->nullable();
            $table->string('middlename', 200)->nullable();
            $table->string('lastname', 200)->nullable();
            $table->string('mobile', 100)->nullable();
            $table->string('personal_email', 200)->nullable();
            $table->string('pan_no', 20)->nullable()->unique();
            $table->string('pan_pic', 255)->nullable();
            $table->string('adhar_no', 20)->nullable()->unique();
            $table->string('adhar_pic', 255)->nullable();
            $table->text('temporary_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->enum('user_status', ['1', '0'])->default('1');
            $table->string('occupation', 100)->nullable();
            $table->string('company_webmail', 100)->nullable()->unique();
            $table->string('company_gmail', 100)->nullable();
            $table->string('gmail_password', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->enum('marital_status', ['M', 'U'])->nullable();
            $table->string('blood_group', 100)->nullable();
            $table->string('account_no', 100)->nullable();
            $table->string('ifsc_code', 100)->nullable();
            $table->string('passbook_pic', 255)->nullable();
            $table->string('dob', 100)->nullable();
            $table->string('joining_date', 100)->nullable();
            $table->string('employee_code', 100)->nullable();
            $table->string('position', 100)->nullable();
            $table->string('duty_in_time', 100)->nullable();
            $table->string('duty_out_time', 100)->nullable();
            $table->string('current_status', 100)->nullable();
            $table->string('qualification', 100)->nullable();
            $table->string('esenceweb_experience', 100)->nullable();
            $table->string('total_experience', 100)->nullable();
            $table->string('previous_experience', 100)->nullable();
            $table->string('other_experience', 100)->nullable();
            $table->string('probation_end', 100)->nullable();
            $table->string('experience', 100)->nullable();
            $table->string('passport_pic', 100)->nullable();
            $table->string('address_proof_pic', 100)->nullable();
            $table->string('experience_letter_pic', 100)->nullable();
            $table->string('educational_certificate_pic', 100)->nullable();
            // $table->string('_token', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_users');
    }
};
