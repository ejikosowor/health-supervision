<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->insert(array(
            array('name' => 'Radio Question'),
            array('name' => 'Checkbox Question'),
            array('name' => 'Open Ended Question'),
            array('name' => 'Compound Question'),
            array('name' => 'Section Question'),
        ));
    }
}