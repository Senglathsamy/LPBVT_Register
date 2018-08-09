<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubTeachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_teach', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('te_id')->unsigned()->nullable();
            $table->integer('subb_id')->unsigned()->nullable();
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
        Schema::dropIfExists('sub_teach');
    }
}
