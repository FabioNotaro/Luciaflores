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
        if (!Schema::hasTable('cliente')) {
            Schema::create('cliente', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->bigInteger('doc');
                $table->string('email');
                $table->bigInteger('phone');
                $table->dateTime('dt_created');
                $table->interger('id_created');
                $table->dateTime('dt_deleted');
                $table->interger('id_deleted');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
