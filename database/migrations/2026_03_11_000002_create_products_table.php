<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('calories')->default(0);
            $table->unsignedInteger('protein')->default(0);
            $table->unsignedInteger('carb')->default(0);
            $table->unsignedInteger('fat')->default(0);
            $table->unsignedInteger('fiber')->default(0);
            $table->unsignedInteger('sugar')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_vegetarian')->default(false);
            $table->string('goal_tag')->nullable(); // giảm cân / tăng cơ / maintain
            $table->string('image_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

