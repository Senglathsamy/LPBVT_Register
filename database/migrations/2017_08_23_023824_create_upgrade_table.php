<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpgradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upgrade', function (Blueprint $table) {
            $table->increments('ug_id');
            $table->date('ug_paiddate');
            $table->string('ug_recieptno', 25);
            $table->string('st_id', 15)->nullable();
            $table->integer('subj_id')->unsigned()->nullable();
            $table->foreign('st_id')->references('st_id')->on('students');
            $table->foreign('subj_id')->references('id')->on('subjects');
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
        Schema::dropIfExists('upgrade');
    }
}
