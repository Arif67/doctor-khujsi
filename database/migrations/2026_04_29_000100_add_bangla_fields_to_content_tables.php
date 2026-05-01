<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
            $table->text('description_bn')->nullable()->after('description');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->longText('description_bn')->nullable()->after('description');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->string('short_description_bn')->nullable()->after('short_description');
            $table->longText('content_bn')->nullable()->after('content');
            $table->string('meta_title_bn')->nullable()->after('meta_title');
            $table->text('meta_description_bn')->nullable()->after('meta_description');
            $table->string('meta_keywords_bn')->nullable()->after('meta_keywords');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn([
                'title_bn',
                'short_description_bn',
                'content_bn',
                'meta_title_bn',
                'meta_description_bn',
                'meta_keywords_bn',
            ]);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'title_bn',
                'description_bn',
            ]);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'name_bn',
                'description_bn',
            ]);
        });
    }
};
