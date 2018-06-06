<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CountiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('counties')->insert(array(
            array('name' => 'Mombasa'),
            array('name' => 'Kwale'),  
            array('name' => 'Kilifi'),
            array('name' => 'Tana River'),
            array('name' => 'Lamu'),
            array('name' => 'Taita Taveta'),
            array('name' => 'Garissa'),
            array('name' => 'Wajir'),
            array('name' => 'Mandera'),
            array('name' => 'Marsabit'),
            array('name' => 'Isiolo'),
            array('name' => 'Meru'),
            array('name' => 'Tharaka Nithi'),
            array('name' => 'Embu'),
            array('name' => 'Kitui'),
            array('name' => 'Machakos'),
            array('name' => 'Makueni'),
            array('name' => 'Nyandarua'),
            array('name' => 'Nyeri'),
            array('name' => 'Kirinyaga'),
            array('name' => 'Murang\'a'),
            array('name' => 'Kiambu'),
            array('name' => 'Turkana'),
            array('name' => 'West Pokot'),
            array('name' => 'Samburu'),
            array('name' => 'Trans Nzoia'),
            array('name' => 'Uasin Gishu'),
            array('name' => 'Elgeyo Marakwet'),
            array('name' => 'Nandi'),
            array('name' => 'Baringo'),
            array('name' => 'Laikipia'),
            array('name' => 'Nakuru'),
            array('name' => 'Narok'),
            array('name' => 'Kajiado'),
            array('name' => 'Kericho'),
            array('name' => 'Bomet'),
            array('name' => 'Kakamega'),
            array('name' => 'Vihiga'),
            array('name' => 'Bungoma'),
            array('name' => 'Busia'),
            array('name' => 'Siaya'),
            array('name' => 'Kisumu'),
            array('name' => 'Homa Bay'),
            array('name' => 'Migori'),
            array('name' => 'Kisii'),
            array('name' => 'Nyamira'),
            array('name' => 'Nairobi')
        ));
    }
}
