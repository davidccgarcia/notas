<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguridad extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('roles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->nullableTimestamps();
        });

        Schema::create('usuarios', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id')->unsigned();
            $table->string('nombre', 50);
            $table->string('usuario', 50);
            $table->string('email', 50);
            $table->string('avatar', 50)->nullable();
            $table->string('password', 100);
            $table->rememberToken();
            $table->nullableTimestamps();
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->unique('email');
        });

        Schema::create('rutas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('ruta', 50);
            $table->nullableTimestamps();
        });

        Schema::create('permisos', function(Blueprint $table) {
            $table->integer('rol_id')->unsigned();
            $table->integer('ruta_id')->unsigned();
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreign('ruta_id')->references('id')->on('rutas');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('usuarios');
        Schema::drop('permisos');
        Schema::drop('roles');
        Schema::drop('rutas');
    }

}
