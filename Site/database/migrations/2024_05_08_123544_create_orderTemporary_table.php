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
                $table->string('order_number');
                $table->string('customer');
                $table->string('customer_tel');
                $table->string('product');
                $table->decimal('value', 5, 2);
                $table->smallInteger('payment_type');
                $table->smallInteger('payment_status');
                $table->date('dt_order');
                $table->time('time_order');
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
