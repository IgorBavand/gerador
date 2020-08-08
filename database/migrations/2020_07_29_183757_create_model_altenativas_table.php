<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelAltenativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternativa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_questao')->unsigned();
            $table->foreign('id_questao')->references('id')->on('questao')->onDelete('cascade')->onUpdate('cascade');
            $table->string('alternativa');  
            $table->string('check');  
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
        Schema::dropIfExists('altenativa');
    }
}
