<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanApplicationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('loan_id');
            $table->string('application_id')->unique();
            $table->unsignedBigInteger('payable_amount');
            $table->unsignedBigInteger('monthly_installment');
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->decimal('due_amount', 15, 2)->default(0);
            $table->decimal('expend_amount', 15, 2)->default(0);
            $table->enum('loan_purpose', ['Business', 'Personal', 'Education', 'Medical', 'Other'])->default('Personal');
            $table->text('loan_perporse');
            $table->text('collateral_details')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'closed'])->default('pending');
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('client_id')
                  ->references('id')
                  ->on('clients')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreign('loan_id')
                  ->references('id')
                  ->on('loans')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreign('creator')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreign('editor')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
}
