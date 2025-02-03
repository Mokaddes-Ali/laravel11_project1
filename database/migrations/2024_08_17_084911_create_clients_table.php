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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone_number');
            $table->date('date_of_birth');
            $table->string('nid_number')->unique();
            $table->string('nid_pic_font')->nullable();
            $table->string('nid_pic_back')->nullable();
            $table->string('occupation');
            $table->decimal('monthly_income', 10, 2);
            $table->string('present_district');
            $table->string('present_upazila');
            $table->string('present_village')->nullable();
            $table->string('present_postcode')->nullable();
            $table->string('permanent_district');
            $table->string('permanent_upazila');
            $table->string('permanent_postcode')->nullable();
            $table->string('permanent_village')->nullable();
            $table->string('email')->unique();
            $table->string('number')->unique();
            $table->string('emergency_contact_name');
            $table->string('pic')->nullable();
            $table->unsignedBigInteger('loan_amount');
            $table->enum('loan_type', ['personal', 'business', 'home', 'education', 'other']);
            $table->text('purpose')->nullable();
            $table->date('loan_start_date');
            $table->enum('loan_status', ['pending', 'approved', 'rejected', 'ongoing', 'completed'])->default('pending'); // লোনের স্ট্যাটাস
            $table->string('guarantor_name');
            $table->string('guarantor_nid');
            $table->string('guarantor_nid_pic_font')->nullable();
            $table->string('guarantor_nid_pic_back')->nullable();
            $table->string('guarantor_address');
            $table->string('guarantor_occupation');
            $table->decimal('guarantor_monthly_income', 10, 2)->nullable();
            $table->string('guarantor_phone_number');
            $table->string('guarantor_email')->nullable();
            $table->string('guarantor_pic')->nullable();
            $table->string('guarantor_relation');
            $table->boolean('has_previous_loan')->default(false);
            $table->boolean('insurance_taken')->default(false);
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->date('loan_applied_date');
            $table->date('loan_approved_date')->nullable();
            $table->string('slug', 50)->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

                // Foreign key constraints with cascadeOnUpdate and restrictOnDelete
                $table->forein('loan_amount')
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
