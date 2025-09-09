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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('office_phone')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->string('photo')->nullable();
             $table->text('description')->nullable();
            $table->json('educations')->nullable(); // array of {title, details}
            $table->json('shifts')->nullable();     // array of {day, start_time, end_time}
            $table->json('social_links')->nullable();
            
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
