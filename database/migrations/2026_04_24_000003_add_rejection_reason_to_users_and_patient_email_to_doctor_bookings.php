<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('approved_at');
        });

        Schema::table('doctor_bookings', function (Blueprint $table) {
            $table->string('patient_email')->nullable()->after('patient_phone');
        });
    }

    public function down(): void
    {
        Schema::table('doctor_bookings', function (Blueprint $table) {
            $table->dropColumn('patient_email');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });
    }
};
