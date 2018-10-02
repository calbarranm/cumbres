<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bb1162d99da2RelationshipsToPruebaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pruebas', function(Blueprint $table) {
            if (!Schema::hasColumn('pruebas', 'asignatura_id')) {
                $table->integer('asignatura_id')->unsigned()->nullable();
                $table->foreign('asignatura_id', '213764_5bb1162c651b9')->references('id')->on('asignaturas')->onDelete('cascade');
                }
                if (!Schema::hasColumn('pruebas', 'asignaturas_id')) {
                $table->integer('asignaturas_id')->unsigned()->nullable();
                $table->foreign('asignaturas_id', '213764_5bb1162c81468')->references('id')->on('asignaturas')->onDelete('cascade');
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
        Schema::table('pruebas', function(Blueprint $table) {
            
        });
    }
}
