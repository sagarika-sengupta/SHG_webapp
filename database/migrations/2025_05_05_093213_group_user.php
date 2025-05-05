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
        Schema::create('group_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('group_id');
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
           // $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            //It specifies that when the referenced record in the parent table is deleted, all related records in the child table should also be automatically deleted.
            $table->string('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            //$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unique(['group_id', 'user_id']); // <-- This prevents duplicates
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_user');
    }
};
