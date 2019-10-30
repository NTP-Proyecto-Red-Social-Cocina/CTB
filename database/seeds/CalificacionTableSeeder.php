<?php

use Illuminate\Database\Seeder;

class CalificacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Calificacion', 600)->create();
    }
}
