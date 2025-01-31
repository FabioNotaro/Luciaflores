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
        if (!Schema::hasTable('orderTemporary')) {
            Schema::create('orderTemporary', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('order_number')->unique()->nullable()->default('000000');
                $table->string('customer');
                $table->string('customer_tel');
                $table->string('product');
                $table->smallInteger('payment_type');
                $table->smallInteger('payment_status');
                $table->dateTime('dt_order');
                $table->integer('time_order');
                $table->string('receiver');
                $table->string('tel_receiver');
                $table->text('address');
                $table->text('address_complement');
                $table->text('message');
                $table->string('_token');
                $table->dateTime('dt_created');
                $table->integer('id_created');
                $table->dateTime('dt_deleted');
                $table->integer('id_deleted');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderTemporary');
    }
};
