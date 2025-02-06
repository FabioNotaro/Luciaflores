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
        if (!Schema::hasTable('contacts_rel')) {
            Schema::create('contacts_rel', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_customer');
                $table->integer('id_customer_contact');
                $table->string('rel');
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
        Schema::dropIfExists('contacts_rel');
    }
};
