<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supervision_categories')->insert(array(
            array('name' => 'Management'),
            array('name' => 'HRH'),
            array('name' => 'Service Availability'),
            array('name' => 'MCH'),
            array('name' => 'Maternity'),
            array('name' => 'Post-Abortal Care'),
            array('name' => 'HMIS'),
            array('name' => 'Pharmacy/Commodities'),
            array('name' => 'Lab'),
        ));
    }
}