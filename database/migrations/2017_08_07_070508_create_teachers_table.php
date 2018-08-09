<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id', 4);
            $table->string('te_firstname', 50);
            $table->string('te_lastname', 50);
            $table->string('te_gender', 3);
            $table->string('te_nationality', 12);
            $table->string('te_Region', 10);
            $table->string('te_phone', 15);
            $table->string('te_major', 25);
            $table->string('te_degree', 15);
            $table->integer('dept_id')->unsigned();
            $table->foreign('dept_id')->references('id')->on('department');
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
        Schema::dropIfExists('teachers');
    }
}
