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
        if (!Schema::hasTable('order')) {
            Schema::create('order', function (Blueprint $table) {
                $table->id();
                $table->integer('id_address');
                $table->integer('id_cliente');
                $table->integer('id_product');
                $table->integer('order_code');
                $table->dateTime('dt_order');
                $table->integer('id_time_order');
                $table->string('person');
                $table->text('person_address');
                $table->bigInteger('person_phone');
                $table->text('person_message');
                $table->string('person_message_from');
                $table->string('person_message_to');
                $table->text('note');
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
        Schema::dropIfExists('order');
    }
};
