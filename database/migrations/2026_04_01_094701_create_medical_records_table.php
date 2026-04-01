<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id(); // RecordID
            $table->foreignId('patient_id')->unique()->constrained()->onDelete('cascade');
            $table->string('blood_type');
            $table->text('allergies')->nullable();
            $table->text('chronic_conditions')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
