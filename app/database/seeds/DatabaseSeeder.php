<?php

class DatabaseSeeder extends Seeder {

    public function run() {

        $this->call('RolesTableSeeder');
        $this->command->info('Se ejecuto Correctamente RolesTableSeeder');
        $this->call('UsuariosTableSeeder');
        $this->command->info('Se ejecuto Correctamente UsuariosTableSeeder');
	}

}
