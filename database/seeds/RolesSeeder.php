<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            array('name' => 'Super Admin'),
            array('name' => 'Supervisor'),
            array('name' => 'CHMT'),
            array('name' => 'Health Representative')
        ));
    }
}
