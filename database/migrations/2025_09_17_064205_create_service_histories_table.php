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
        Schema::create('service_histories', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('appointment_id');  
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');

            $table->unsignedBigInteger('doctor_id');  
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            
            $table->unsignedBigInteger('patient_id');  
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('service_id');  
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->enum('status',['done','panding','cencel'])->default('panding');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_histories');
    }
};
