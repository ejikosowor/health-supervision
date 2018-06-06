<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supervision_areas')->insert(array(
            array('name' => 'ANC'),
            array('name' => 'Infrastructure'),
            array('name' => 'Service Quality'),
            array('name' => 'PNC'),
            array('name' => 'FP')
        ));
    }
}
