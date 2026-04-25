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
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
            $table->foreignId('handled_by_id')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            $table->string('subject', 150)->nullable()->after('email');
            $table->string('type', 20)->default('public')->after('subject');
            $table->string('priority', 20)->default('normal')->after('type');
            $table->string('status', 20)->default('open')->after('priority');
            $table->text('admin_reply')->nullable()->after('message');
            $table->timestamp('replied_at')->nullable()->after('admin_reply');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('handled_by_id');
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn([
                'subject',
                'type',
                'priority',
                'status',
                'admin_reply',
                'replied_at',
            ]);
        });
    }
};
