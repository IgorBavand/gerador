<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelQuestaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questao', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
             
            
            /*
            aqui deu erro n consegui resolver
            $table->string('id_assunto')->unsigned();
            $table->foreign('id_assunto')->references('assunto')->on('assunto')->onDelete('cascade')->onUpdate('cascade');
            */
            $table->string('assunto');
            $table->text('texto');   
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
        Schema::dropIfExists('questao');
    }
}