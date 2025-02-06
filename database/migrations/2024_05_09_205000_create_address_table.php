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
        if (!Schema::hasTable('address')) {
            Schema::create('address', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_customer');
                $table->string('line_01');
                $table->string('line_02');
                $table->string('city');
                $table->string('state');
                $table->text('complement');
                $table->integer('zip');
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
        Schema::dropIfExists('address');
    }
};
