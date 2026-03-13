<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                if (! Schema::hasColumn('categories', 'slug')) {
                    $table->string('slug')->nullable()->after('name');
                }
                if (! Schema::hasColumn('categories', 'sort_order')) {
                    $table->unsignedInteger('sort_order')->default(0)->after('description');
                }
                if (! Schema::hasColumn('categories', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('sort_order');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                if (Schema::hasColumn('categories', 'slug')) {
                    $table->dropColumn('slug');
                }
                if (Schema::hasColumn('categories', 'sort_order')) {
                    $table->dropColumn('sort_order');
                }
                if (Schema::hasColumn('categories', 'is_active')) {
                    $table->dropColumn('is_active');
                }
            });
        }
    }
};

