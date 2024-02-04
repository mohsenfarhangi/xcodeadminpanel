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
        Schema::create('attendance_times', function (Blueprint $table) {
            $table->id();
            $table->integer('dentist_id');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('type')->nullable();
            $table->string('day_in_week')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_times');
    }
};
