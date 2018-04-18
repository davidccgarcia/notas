<?php

class UsuariosTableSeeder extends Seeder {

    public function run() {
        DB::table('usuarios')->insert(array(
            array(
                'rol_id' => 1,
                'nombre' => 'Administrador',
                'usuario' => 'admin',
                'password' => Hash::make('12345'),
                'email' => 'admin@mail.com',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            
        ));
    }

}
