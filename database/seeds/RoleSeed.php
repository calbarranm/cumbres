<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrador (puede crear otros usuarios)',],
            ['id' => 3, 'title' => 'Profesor',],
            ['id' => 4, 'title' => 'Alumno',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
