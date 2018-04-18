<?php

class RutasTableSeeder extends Seeder {

    public function run() {
        DB::table('usuarios')->insert(array(
            array(
                'ruta' => 'usuarios',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            )
        ));
    }

}
