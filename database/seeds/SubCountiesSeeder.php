<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SubCountiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
    	DB::table('sub_counties')->insert(array(
            array('name' => 'Dagoretti North', 'county_id' => 47),
            array('name' => 'Dagoretti South', 'county_id' => 47),
            array('name' => 'Embakasi Central', 'county_id' => 47),
            array('name' => 'Embakasi East', 'county_id' => 47),
            array('name' => 'Embakasi North', 'county_id' => 47),
            array('name' => 'Embakasi South', 'county_id' => 47),
            array('name' => 'Embakasi West', 'county_id' => 47),
            array('name' => 'Kamukunji', 'county_id' => 47),
            array('name' => 'Kasarani', 'county_id' => 47),
            array('name' => 'Kibera', 'county_id' => 47),
            array('name' => 'Langata', 'county_id' => 47),
            array('name' => 'Makadara', 'county_id' => 47),
            array('name' => 'Mathare', 'county_id' => 47),
            array('name' => 'Roysambu', 'county_id' => 47),
            array('name' => 'Ruaraka', 'county_id' => 47),
            array('name' => 'Starehe', 'county_id' => 47),
            array('name' => 'Westlands', 'county_id' => 47),
        ));
    }
}