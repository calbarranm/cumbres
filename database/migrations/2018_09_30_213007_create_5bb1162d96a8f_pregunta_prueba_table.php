<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5bb1162d96a8fPreguntaPruebaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('pregunta_prueba')) {
            Schema::create('pregunta_prueba', function (Blueprint $table) {
                $table->integer('pregunta_id')->unsigned()->nullable();
                $table->foreign('pregunta_id', 'fk_p_213762_213764_prueba_5bb1162d96c0a')->references('id')->on('preguntas')->onDelete('cascade');
                $table->integer('prueba_id')->unsigned()->nullable();
                $table->foreign('prueba_id', 'fk_p_213764_213762_pregun_5bb1162d96ce2')->references('id')->on('pruebas')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregunta_prueba');
    }
}
