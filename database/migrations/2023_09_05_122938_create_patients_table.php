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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer('doc_num');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nickname')->nullable();
            $table->string('avatar')->nullable();
            $table->string('father_name')->nullable();
            $table->string('certificate_num')->nullable();
            $table->string('national_code')->unique();
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->boolean('marital_status')->default(false);
            $table->boolean('send_sms')->default(true);
            $table->dateTime('birthdate')->nullable();
            $table->dateTime('register_date')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('pregnancy')->nullable();
            $table->text('surgery_history')->nullable();
            $table->string('description')->nullable();
            $table->string('education')->nullable();
            $table->string('presenter')->nullable();
            $table->string('job')->nullable();
            $table->string('birthplaced')->nullable();
            $table->string('phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('mobile')->nullable();
            $table->text('home_address')->nullable();
            $table->text('work_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
