<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hospital_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('reviewer_name');
            $table->string('reviewer_email')->nullable();
            $table->unsignedTinyInteger('rating');
            $table->text('review');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hospital_reviews');
    }
};
