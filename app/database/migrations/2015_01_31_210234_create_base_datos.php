<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseDatos extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {


        /**
         * Aqui se encontraran todos los tipos de tiempo que hay en la app horas minutos dias
         */
        Schema::create('tipos_tiempo', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->nullableTimestamps();
        });


        /**
         * Aqui se encontraran todos los proyectos creados en la app
         */
        Schema::create('proyectos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('alias', 50)->nullable();
            $table->string('avatar', 50)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('usuario_id')->unsigned();
            $table->nullableTimestamps();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->unique('alias');
        });

        /**
         * Aqui se encontraran todos los estados disponibles por proyecto
         */
        Schema::create('proyectos_estados', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('proyecto_id')->unsigned();
            $table->string('nombre', 50);
            $table->nullableTimestamps();
        });

        /**
         * Aqui se encontraran todos los estados disponibles por proyecto
         */
        Schema::create('proyectos_estados_asignados', function(Blueprint $table) {

            $table->integer('proyecto_estado_id')->unsigned();
            $table->integer('proyecto_id')->unsigned();
            $table->foreign('proyecto_estado_id')->references('id')->on('proyectos_estados');
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            $table->nullableTimestamps();
        });

        Schema::create('tareas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('proyecto_id')->unsigned();
            $table->integer('tarea_padre_id')->nullable();
            $table->string('nombre', 50)->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('alias', 50);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->float('porcentaje_avance');
            $table->integer('usuario_id')->unsigned();
            $table->nullableTimestamps();
            $table->unique('alias');
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });

            /**
         * Aqui se encontraran todos los estados disponibles por tsareas
         */
        Schema::create('tareas_estados', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tarea_id')->unsigned();
            $table->string('nombre', 50);
            $table->nullableTimestamps();
        });

        /**
         * Aqui se encontraran todos los estados disponibles por tarea
         */
        Schema::create('tareas_estados_asignados', function(Blueprint $table) {

            $table->integer('tarea_estado_id')->unsigned();
            $table->integer('tarea_id')->unsigned();
            $table->foreign('tarea_estado_id')->references('id')->on('tareas_estados');
            $table->foreign('tarea_id')->references('id')->on('tareas');
            $table->nullableTimestamps();
        });
        
        Schema::create('responsables_tareas', function(Blueprint $table) {
            $table->integer('tarea_id');
            $table->integer('usuario_id')->unsigned();
            $table->float('tiempo_empleado')->nullable();
            $table->integer('tipo_tiempo_empleado_id')->unsigned();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->nullableTimestamps();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('tipo_tiempo_empleado_id')->references('id')->on('tipos_tiempo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
        Schema::drop('proyectos_estados_asignados');
        Schema::drop('proyectos_estados');
         Schema::drop('tareas_estados_asignados');
        Schema::drop('tareas_estados');
        Schema::drop('responsables_tareas');
        Schema::drop('tipos_tiempo');
        Schema::drop('tareas');
        Schema::drop('proyectos');
    }

}
