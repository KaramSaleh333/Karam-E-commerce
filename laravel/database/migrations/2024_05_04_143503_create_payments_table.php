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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('products_id')->constrained();
            $table->integer('seller_id');
            $table->string('products_name');
            $table->string('product_image_path');
            $table->integer('InvoiceId');
            $table->string('InvoiceStatus');
            $table->string('InvoiceDisplayValue');
            $table->integer('amount');
            $table->date('TransactionDate');
            $table->string('PaymentGateway');
            $table->integer('TransactionId');
            $table->integer('PaymentId');
            $table->string('TransactionStatus');
            $table->string('Country');
            $table->string('CardNumber');
            $table->timestamps('shipped_at');
            $table->timestamps('delivered_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
