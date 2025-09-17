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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->string('appointment_id');
           
            $table->unsignedBigInteger('patient_id');  
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('department_id');  
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->unsignedBigInteger('assign_by')->nullable();  
            $table->foreign('assign_by')->references('id')->on('doctors')->onDelete('cascade');

            $table->date('appointment_date');
            $table->string('appointment_time');

            $table->string('serial_no')->nullable();

            $table->text('message');

            $table->enum('status',['confirm','pending'])->default('pending');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
