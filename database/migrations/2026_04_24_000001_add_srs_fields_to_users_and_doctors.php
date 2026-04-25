<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('hospital_name')->nullable()->after('last_name');
            $table->string('hospital_location')->nullable()->after('address');
            $table->string('approval_status')->default('approved')->after('remember_token');
            $table->timestamp('approved_at')->nullable()->after('approval_status');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->foreignId('owner_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
            $table->string('speciality')->nullable()->after('department_id');
            $table->string('experience')->nullable()->after('speciality');
            $table->boolean('show_on_homepage')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropConstrainedForeignId('owner_id');
            $table->dropColumn(['speciality', 'experience', 'show_on_homepage']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['hospital_name', 'hospital_location', 'approval_status', 'approved_at']);
        });
    }
};
