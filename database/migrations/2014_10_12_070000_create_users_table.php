<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
     public function up(){

         if (!Schema::hasTable('users')) {
             Schema::create('users', function (Blueprint $table) {
                 $table->id();
                 $table->string('name');
                 $table->string('email')->unique();
                 $table->timestamp('email_verified_at')->nullable();
                 $table->string('password');
                 $table->rememberToken();
                 $table->timestamps();
             });
         }

         Schema::dropIfExists('sessions');
         if (!Schema::hasTable('sessions')) {
             Schema::create('sessions', function (Blueprint $table) {
                 $table->string('id', 191)->primary();
                 $table->unsignedBigInteger('user_id');
                 $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                 $table->string('ip_address', 45)->nullable();
                 $table->text('user_agent')->nullable();
                 $table->longText('payload');
                 $table->unsignedBigInteger('last_activity')->index();
             });
         }
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
