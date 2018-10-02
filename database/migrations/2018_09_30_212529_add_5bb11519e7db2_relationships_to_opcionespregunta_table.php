<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bb11519e7db2RelationshipsToOpcionesPreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opciones_preguntas', function(Blueprint $table) {
            if (!Schema::hasColumn('opciones_preguntas', 'pregunta_id')) {
                $table->integer('pregunta_id')->unsigned()->nullable();
                $table->foreign('pregunta_id', '213763_5bb11518ee97a')->references('id')->on('preguntas')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opciones_preguntas', function(Blueprint $table) {
            
        });
    }
}
