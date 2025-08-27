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
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('qualification')->nullable();
            $table->string('specialization')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('photo')->nullable();
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
