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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('loan_id')->unique();
            $table->decimal('amount', 15, 2);
            $table->integer('duration');
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('total_pay_amount', 15, 2);
            $table->decimal('monthly_pay_amount', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
