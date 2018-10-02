<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bb11311cb869RelationshipsToUnidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidades', function(Blueprint $table) {
            if (!Schema::hasColumn('unidades', 'unidad_id')) {
                $table->integer('unidad_id')->unsigned()->nullable();
                $table->foreign('unidad_id', '213761_5bb11310e2dab')->references('id')->on('asignaturas')->onDelete('cascade');
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
        Schema::table('unidades', function(Blueprint $table) {
            
        });
    }
}
