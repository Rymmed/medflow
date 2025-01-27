<?php

use App\Enums\AppointmentStatus;
use App\Enums\ConsultationType;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->dateTime('start_date');
            $table->dateTime('finish_date')->nullable();
            $table->string('consultation_reason', 255)->nullable();
            $table->enum('consultation_type', ConsultationType::getValues());
            $table->enum('status', AppointmentStatus::getValues())->default(AppointmentStatus::PENDING);
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('users');
            $table->foreign('doctor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
