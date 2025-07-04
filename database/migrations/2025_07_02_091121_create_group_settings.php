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
        Schema::create('group_settings', function (Blueprint $table) {
            //$table->id();
            $table->string('group_id',110);
            $table->string('group_name');
            $table->decimal('monthly_contribution',8,2);
            $table->string('max_members');
            $table->string('user_count');
            $table->string('status');
            $table->timestamps();

             // Foreign key constraints
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
            //$table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_settings');
    }
};
