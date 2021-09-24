<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subjetiva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('subjetiva', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_questao')->unsigned();
            $table->foreign('id_questao')->references('id')->on('questao')->onDelete('cascade')->onUpdate('cascade');

            $table->text('resposta');  
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
        Schema::dropIfExists('subjetiva');

    }
}