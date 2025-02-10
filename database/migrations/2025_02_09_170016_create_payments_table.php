<?php

// database/migrations/xxxx_xx_xx_create_payments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_application_id');
            $table->decimal('amount_paid', 15, 2);
            $table->enum('payment_method', ['cash', 'stripe']);
            $table->string('email')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('loan_application_id')->references('id')->on('loan_applications')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
}

