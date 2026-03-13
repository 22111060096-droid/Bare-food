<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('code')->unique();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->string('customer_address')->nullable();
            $table->text('note')->nullable();
            $table->string('dining_option')->default('takeaway'); // eat_in / takeaway
            $table->string('payment_method')->default('cod'); // cod, transfer, momo, zalopay, vnpay, card
            $table->unsignedInteger('subtotal')->default(0);
            $table->unsignedInteger('discount_amount')->default(0);
            $table->unsignedInteger('total')->default(0);
            $table->unsignedInteger('total_calories')->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

