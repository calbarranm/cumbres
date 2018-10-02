<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1538331927OpcionesPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('opciones_preguntas')) {
            Schema::create('opciones_preguntas', function (Blueprint $table) {
                $table->increments('id');
                $table->text('texto_opcion');
                $table->tinyInteger('correcto')->nullable()->default('0');
                
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
        Schema::dropIfExists('opciones_preguntas');
    }
}
