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
        // Create the groups table
        Schema::create('groups', function (Blueprint $table) {
          //  $table->id();
            $table->string('group_id',110)->primary(); // Unique group identifier and primary key
            $table->string('group_name'); // Name of the group
            $table->string('group_password');
            $table->string('village'); // Location of the group
            $table->string('district'); // Location of the group
            $table->string('state'); // Location of the group
            $table->string('user_id',110); // Foreign key for user
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            //$table->integer('transaction_amount');
            $table->integer('user_count')->default(0); // Number of users in the group
            $table->json('members')->nullable(); // JSON column to store registered users
            //run this
            //$table->json('password');
            $table->timestamps();
        });

        // Create a pivot table for group-user relationships
        Schema::create('group_user', function (Blueprint $table) {
            $table->id();
            $table->string('group_id',110); // Foreign key for group
            $table->string('user_id',110); // Foreign key for user
            $table->string('role')->default('member'); // Role of the user in the group (e.g., member, admin)
            $table->string('status');
            $table->date('date_of_joining');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
       
            $table->unique(['group_id', 'user_id']); // Ensure unique group-user pairs
        });
        Schema::create('group_transaction_settings', function (Blueprint $table) {
            $table->id();
            $table->string('group_id',110); // Foreign key for group
            $table->string('user_id',110); // Foreign key for user
            $table->string('transaction_amount'); // Role of the user in the group (e.g., member, admin)
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
       
            $table->unique(['group_id', 'user_id']); // Ensure unique group-user pairs
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_user');
        Schema::dropIfExists('groups');
    }
};