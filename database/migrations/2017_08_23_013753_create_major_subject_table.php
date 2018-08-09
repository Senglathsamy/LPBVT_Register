<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_major', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->string('term');
            $table->integer('ma_id')->unsigned();
            $table->integer('subb_id')->unsigned();
            $table->integer('de_id')->unsigned();
            $table->foreign('ma_id')->references('id')->on('majors')->onDelete('cascade');
            $table->foreign('subb_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('de_id')->references('id')->on('degree')->onDelete('cascade');
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
        Schema::dropIfExists('sub_major');
    }
}
