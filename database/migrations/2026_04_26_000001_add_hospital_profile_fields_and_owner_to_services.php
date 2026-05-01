<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'about_hospital')) {
                $table->longText('about_hospital')->nullable()->after('hospital_name');
            }

            if (! Schema::hasColumn('users', 'privacy_policy')) {
                $table->longText('privacy_policy')->nullable()->after('hospital_location');
            }
        });

        Schema::table('services', function (Blueprint $table) {
            if (! Schema::hasColumn('services', 'owner_id')) {
                $table->foreignId('owner_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'owner_id')) {
                $table->dropConstrainedForeignId('owner_id');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            $dropColumns = array_filter([
                Schema::hasColumn('users', 'about_hospital') ? 'about_hospital' : null,
                Schema::hasColumn('users', 'privacy_policy') ? 'privacy_policy' : null,
            ]);

            if ($dropColumns !== []) {
                $table->dropColumn($dropColumns);
            }
        });
    }
};
