<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FacilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facility_types')->insert(array(
            array('name' => 'Medical Clinic'),
            array('name' => 'Dispensary'),
            array('name' => 'Other Hospital'),
            array('name' => 'Health Centre'),
            array('name' => 'Nursing Home'),
            array('name' => 'Training Institution In Health (stand-Alone)'),
            array('name' => 'Vct Centre (stand-Alone)'),
            array('name' => 'Sub-District Hospital'),
            array('name' => 'Dental Clinic'),
            array('name' => 'Laboratory (stand-Alone)'),
            array('name' => 'Health Project'),
            array('name' => 'District Hospital'),
            array('name' => 'Maternity Home'),
            array('name' => 'Medical Centre'),
            array('name' => 'Provincial General Hospital'),
            array('name' => 'Health Programme'),
            array('name' => 'District Health Office'),
            array('name' => 'Not In List'),
            array('name' => 'National Referral Hospital'),
            array('name' => 'Eye Clinic'),
            array('name' => 'Funeral Home (stand-Alone)'),
            array('name' => 'Radiology Unit'),
            array('name' => 'Eye Centre'),
            array('name' => 'Rural Health Training Centre'),
            array('name' => 'Blood Bank'),
            array('name' => 'Regional Blood Transfusion Centre')
        ));
    }
}
