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
           // $table->id();
            $table->string('group_id')->primary(); // Unique group identifier and primary key
            $table->string('group_name'); // Name of the group
            $table->string('village'); // Location of the group
            $table->string('district'); // Location of the group
            $table->string('state'); // Location of the group
            $table->string('user_id'); // Foreign key for user
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->integer('user_count')->default(0); // Number of users in the group
            $table->json('members')->nullable(); // JSON column to store registered users
            //run this
            //$table->json('password');
            $table->timestamps();
        });

        // Create a pivot table for group-user relationships
        Schema::create('group_user', function (Blueprint $table) {
            $table->id();
            $table->string('group_id'); // Foreign key for group
            $table->string('user_id'); // Foreign key for user
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