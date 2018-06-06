<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FacilityOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facility_owners')->insert(array(
            array('name' => 'Private Practice - Clinical Officer'),
            array('name' => 'Ministry Of Health'),
            array('name' => 'Kenya Episcopal Conference-Catholic Secretariat'),
            array('name' => 'Christian Health Association Of Kenya'),
            array('name' => 'Private Practice - General Practitioner'),
            array('name' => 'Armed Forces'),
            array('name' => 'Private Enterprise (institution)'),
            array('name' => 'Other Faith Based'),
            array('name' => 'Private Practice - Nurse / Midwife'),
            array('name' => 'Non-Governmental Organizations'),
            array('name' => 'Private Practice - Medical Specialist'),
            array('name' => 'Community Development Fund'),
            array('name' => 'Local Authority'),
            array('name' => 'Private Practice - Unspecified'),
            array('name' => 'Other Public Institution'),
            array('name' => 'Company Medical Service'),
            array('name' => 'Academic (if Registered)'),
            array('name' => 'Community'),            
            array('name' => 'dummy owner'),            
            array('name' => 'Local Authority T Fund'),
            array('name' => 'Parastatal'),
            array('name' => 'Supreme Council For Kenya Muslims'),
            array('name' => 'State Coorporation'),
            array('name' => 'Not In List'),
            array('name' => 'Humanitarian Agencies'),
            
        ));
    }
}
