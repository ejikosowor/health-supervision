<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Question::class, 30)->create();
        DB::table('questions')->insert(array(
            array('question' => 'Thermometer', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'BP Machine', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Pediatric weighing scale', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Stadiometer', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Adult weighing scale', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Adult height measure', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Stethoscope', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Torch / flashlight', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'IUCD insertion kit', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Implant insertion/removal kit', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Examination light', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Fetoscope', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Examination couch', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('question' => 'Storage cabinet', 'supervision_category_id' => 2, 'question_type_id' => 1, 'parent_id' => 82, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
        ));
    }
}