<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teach_score', function (Blueprint $table) {
            $table->increments('id');
            $table->string('score_real', 2)->nullable();
            $table->string('score_upgrade', 2)->nullable();
            $table->integer('reg_id')->unsigned()->nullable();
            $table->integer('upg_id')->unsigned()->nullable();
            $table->integer('te_id')->unsigned()->nullable();
            $table->integer('subb_id')->unsigned()->nullable();
            $table->foreign('reg_id')->references('rg_id')->on('register')->onDelete('cascade');
            $table->foreign('upg_id')->references('ug_id')->on('upgrade')->onDelete('cascade');
            $table->foreign('te_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('subb_id')->references('id')->on('subjects')->onDelete('cascade');
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
        Schema::dropIfExists('teach_score');
    }
}
