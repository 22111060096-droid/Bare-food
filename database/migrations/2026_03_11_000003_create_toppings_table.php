<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('toppings')) {
            Schema::create('toppings', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('category')->nullable(); // ví dụ: protein, carb, veggies, sauce
                $table->unsignedInteger('price')->default(0);
                $table->unsignedInteger('calories')->default(0);
                $table->unsignedInteger('protein')->default(0);
                $table->unsignedInteger('carb')->default(0);
                $table->unsignedInteger('fat')->default(0);
                $table->unsignedInteger('fiber')->default(0);
                $table->unsignedInteger('sugar')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('product_topping')) {
            Schema::create('product_topping', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained()->cascadeOnDelete();
                $table->foreignId('topping_id')->constrained()->cascadeOnDelete();
                $table->unsignedInteger('extra_price')->default(0);
                $table->unsignedInteger('extra_calories')->default(0);
                $table->timestamps();
                $table->unique(['product_id', 'topping_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('product_topping');
        Schema::dropIfExists('toppings');
    }
};

