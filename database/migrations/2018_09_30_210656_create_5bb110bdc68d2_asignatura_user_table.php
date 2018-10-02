<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5bb110bdc68d2AsignaturaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('asignatura_user')) {
            Schema::create('asignatura_user', function (Blueprint $table) {
                $table->integer('asignatura_id')->unsigned()->nullable();
                $table->foreign('asignatura_id', 'fk_p_213760_213745_user_a_5bb110bdc6a05')->references('id')->on('asignaturas')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', 'fk_p_213745_213760_asigna_5bb110bdc6ab6')->references('id')->on('users')->onDelete('cascade');
                
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
        Schema::dropIfExists('asignatura_user');
    }
}
