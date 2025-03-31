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
            $table->id();
            $table->string('group_id')->unique(); // Unique group identifier
            $table->string('group_name'); // Name of the group
            $table->string('village'); // Location of the group
            $table->string('district'); // Location of the group
            $table->string('state'); // Location of the group
            $table->integer('user_count')->default(0); // Number of users in the group
            $table->json('members')->nullable(); // JSON column to store registered users
            $table->timestamps();
        });

        // Create a pivot table for group-user relationships
        Schema::create('group_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id'); // Foreign key for group
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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