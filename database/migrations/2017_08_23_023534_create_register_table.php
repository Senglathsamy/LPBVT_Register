<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register', function (Blueprint $table) {
            $table->increments('rg_id');
            $table->dateTime('rg_date');
            $table->integer('rg_studyyear');
            $table->string('rg_classno', 15)->nullable();
            $table->date('rg_paiddate')->nullable();
            $table->string('rg_recieptno', 25)->nullable();
            $table->string('rg_academicyear', 25);
            $table->string('st_id', 15);
            $table->foreign('st_id')->references('st_id')->on('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register');
    }
}
