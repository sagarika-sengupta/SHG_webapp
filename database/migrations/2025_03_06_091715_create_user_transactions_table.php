<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->string('payment_id',110)->unique();
            $table->string('transaction_id',110)->primary(); // Primary key

            $table->string('group_id',110); // Foreign key for user
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
            //Foreign key constraint (assuming groups.group_id is a string)

            $table->string('user_id',110); // Foreign key for user
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            //Foreign key constraint (assuming users.user_id is a string)
            // $table->string('user_id',50)->unique; // Since user_id is stored as string
            $table->string('status')->default('pending'); // or nullable
            
           
           $table->decimal('amount', 10, 2);
            $table->string('transaction_type'); // Type of transaction
            $table->timestamps();

            // Foreign key constraint (assuming users.user_id is a string)
           // $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    // Create a pivot table for group-user relationships
        // Schema::create('group_user', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('group_id',110); // Foreign key for group
        //     $table->string('user_id',110); // Foreign key for user
        //     $table->timestamps();

        //     // Foreign key constraints
        //     $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
        //     $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
       
        //     $table->unique(['group_id', 'user_id']); // Ensure unique group-user pairs
        // });
    }
    public function down(): void {
        Schema::dropIfExists('user_transactions');
    }
};