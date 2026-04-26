<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('address', 200)->nullable();
            $table->string('phone', 15)->nullable();
            $table->boolean('inactive')->default(false);
            $table->string('image')->nullable();
            $table->unsignedInteger('business_id')->default(1); 
        });


        DB::table('users')->insert([
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'admin@example.com',
            'email_verified_at' => null,
            'password' => '$2y$12$BOoCBskK2wOE1Tt6ZIThR.34ChYvs6vW0KGCd/X1FfpmYJBvrk3pO',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'address' => 'Dhaka',
            'phone' => '01911638946',
            'inactive' => 0,
            'image' => 'profile/7E1iObBxrlLt2dJGcXtcPLosIiCkgCpWGh4jvXyI.jpg', // ✅ fixed column name
            'business_id' => 1, // ✅ fixed column name
        ]);

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
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
