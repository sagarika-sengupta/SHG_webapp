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
        Schema::create('users', function (Blueprint $table) {
         //   $table->id();
            $table->string('name');
            $table->string('phone',110)->unique();
            $table->string('village');
            $table->string('district');
            $table->string('state');
          //  $table->integer('monthly_contribution');
            $table->string('group_id',110)->nullable();
            $table->string('user_id',110)->primary();
            $table->integer('role')->default('0'); // 0 for user, 1 for group, 2 for admin
            //$table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('kyc_data')->nullable();
            $table->boolean('is_kyc_completed')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('user_id',110)->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id',110)->primary();
            $table->foreignId('user_id',110)->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
