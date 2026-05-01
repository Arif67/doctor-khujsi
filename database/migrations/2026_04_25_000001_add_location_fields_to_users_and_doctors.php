<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('district')->nullable()->after('hospital_location');
            $table->string('thana')->nullable()->after('district');
            $table->string('area')->nullable()->after('thana');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->string('district')->nullable()->after('experience');
            $table->string('thana')->nullable()->after('district');
            $table->string('area')->nullable()->after('thana');
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['district', 'thana', 'area']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['district', 'thana', 'area']);
        });
    }
};
