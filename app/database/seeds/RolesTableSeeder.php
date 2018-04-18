<?php

class RolesTableSeeder extends Seeder {

    public function run() {
        DB::table('roles')->insert(array(
            array(
                'id'=>1,
                'nombre' => 'Administrador',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'id'=>2,
                'nombre' => 'lider',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                  'id'=>3,
                'nombre' => 'registrado',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            )
                )
        );
    }

}
