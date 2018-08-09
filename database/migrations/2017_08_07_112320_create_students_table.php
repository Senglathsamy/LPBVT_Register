<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
//            $table->increments('id', 4);
            $table->string('st_id', 15)->primary();
            $table->string('st_fname', 50);
            $table->string('st_lname', 50);
            $table->string('st_gender', 3);
            $table->date('st_bdate');
            $table->string('st_bvillage', 25);
            $table->string('st_bdistrict', 25);
            $table->string('st_bprovince', 25);
            $table->string('st_nationality', 12);
            $table->string('st_region', 10);
            $table->string('st_phone', 15);
            $table->string('st_pvillage', 25);
            $table->string('st_pdistrict', 25);
            $table->string('st_pprovince', 25);
            $table->string('gr_fname', 25);
            $table->string('gr_lname', 25);
            $table->string('gr_phone', 15);
            $table->string('gr_gender', 3);
            $table->integer('ma_id')->unsigned();
            $table->integer('de_id')->unsigned();
            $table->date('st_registerdate');
            $table->integer('st_status')->default(1);
            $table->foreign('ma_id')->references('id')->on('majors');
            $table->foreign('de_id')->references('id')->on('degree');
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
        Schema::dropIfExists('students');
    }
}
