<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dentists', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dr_number')->unique();
            $table->integer('percent')->default(0)->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_card_number')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('speciality');
            $table->string('conversance')->nullable();
            $table->string('university')->nullable();
            $table->string('presenter')->nullable();
            $table->string('dossier')->nullable();
            $table->string('insuranceNum')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile');
            $table->tinyInteger('dentist_abstract')->default(1);
            $table->tinyInteger('dentist_visit_sms')->default(1);
            $table->string('work_address')->nullable();
            $table->string('home_address')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentists');
    }
};
