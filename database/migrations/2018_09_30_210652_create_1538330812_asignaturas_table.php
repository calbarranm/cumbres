<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1538330812AsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('asignaturas')) {
            Schema::create('asignaturas', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nombre');
                $table->string('slug')->nullable();
                $table->text('descripcion')->nullable();
                $table->string('imagen_asignatura')->nullable();
                $table->datetime('fecha_inicio')->nullable();
                $table->tinyInteger('activo')->nullable()->default('0');
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('asignaturas');
    }
}
