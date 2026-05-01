<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('location_districts', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('url')->nullable();
        });

        Schema::create('location_thanas', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('district_id');
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->string('url')->nullable();

            $table->foreign('district_id')->references('id')->on('location_districts')->cascadeOnDelete();
        });

        Schema::create('location_areas', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('thana_id');
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->string('url')->nullable();

            $table->foreign('thana_id')->references('id')->on('location_thanas')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_areas');
        Schema::dropIfExists('location_thanas');
        Schema::dropIfExists('location_districts');
    }
};
