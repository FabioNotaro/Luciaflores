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
         // Criação da tabela 'users' (se não existir)
         if (!Schema::hasTable('users')) {
             Schema::create('users', function (Blueprint $table) {
                 $table->id();  // 'id' como unsignedBigInteger (auto-increment)
                 $table->string('name');
                 $table->string('email')->unique();
                 $table->timestamp('email_verified_at')->nullable();
                 $table->string('password');
                 $table->rememberToken();
                 $table->timestamps();
             });
         }
     
         // Criação da tabela 'sessions' (se não existir)
         Schema::dropIfExists('sessions');
         if (!Schema::hasTable('sessions')) {
             Schema::create('sessions', function (Blueprint $table) {
                 $table->string('id', 191)->primary(); // A chave primária
                 $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade'); // Definindo a chave estrangeira corretamente
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
    }
};
