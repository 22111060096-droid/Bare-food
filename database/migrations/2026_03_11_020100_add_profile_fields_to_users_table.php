<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (! Schema::hasColumn('users', 'phone')) {
                    $table->string('phone')->nullable()->after('password');
                }
                if (! Schema::hasColumn('users', 'membership_level')) {
                    $table->string('membership_level')->default('member')->after('phone');
                }
                if (! Schema::hasColumn('users', 'points')) {
                    $table->unsignedInteger('points')->default(0)->after('membership_level');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'phone')) {
                    $table->dropColumn('phone');
                }
                if (Schema::hasColumn('users', 'membership_level')) {
                    $table->dropColumn('membership_level');
                }
                if (Schema::hasColumn('users', 'points')) {
                    $table->dropColumn('points');
                }
            });
        }
    }
};

