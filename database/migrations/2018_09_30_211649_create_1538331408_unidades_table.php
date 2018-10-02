<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1538331408UnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('unidades')) {
            Schema::create('unidades', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nombre');
                $table->string('slug')->nullable();
                $table->string('imagen_unidad')->nullable();
                $table->text('texto_corto')->nullable();
                $table->text('texto_largo')->nullable();
                $table->integer('posicion')->nullable()->unsigned();
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
        Schema::dropIfExists('unidades');
    }
}
