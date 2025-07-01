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
        Schema::create('users_kyc', function (Blueprint $table) {
            //$table->id();
            //$table->string('group_id',110); // Foreign key for group
            $table->string('user_id',110); // Foreign key for user
            $table->string('name');
            $table->string('phone', 110)->unique();
            $table->string('pan_card',110)->unique();
            $table->string('aadhar_card',110)->unique();
            $table->integer('kyc_flag')->default(0); // 0 for not verified, 1 for verified
            //$table->string('role')->default('member'); // Role of the user in the group (e.g., member, admin)
            $table->timestamps();

            // Foreign key (optional)
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_kyc');
    }
};
