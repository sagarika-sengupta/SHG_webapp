<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_transactions', function (Blueprint $table) {
            //$table->id();
            $table->string('transaction_id')->primary(); // Primary key
            $table->string('user_id'); // Since user_id is stored as string
            $table->decimal('amount', 10, 2);
            $table->enum('transaction_type', ['deposit', 'credit', 'debit']); // Type of transaction
            $table->timestamps();

            // Foreign key constraint (assuming users.user_id is a string)
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_transactions');
    }
};