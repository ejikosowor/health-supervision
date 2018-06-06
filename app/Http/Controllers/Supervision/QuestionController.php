<?php

namespace App\Http\Controllers\Supervision;

use Session;
use App\Question;
use App\QuestionType;
use App\SupervisionArea;
use App\SupervisionCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateQuestion;
use App\Http\Requests\CreateSubQuestion;

class QuestionController extends Controller
{   
    /**
     * Store a new Sub Question
     *
     * @param  CreateSubQuestion  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function subQuestion(CreateSubQuestion $request, $id)
     {
         $question = Question::create([
             'question' => request('sub_question'),
             'supervision_category_id' => $id,
             'parent_id' => request('parent_id'),
             'question_type_id' => request('sub_question_type_id'),
             'supervision_area_id' => request('sub_supervision_area_id')
         ]);
 
         Session::flash('status', 'Successfully added Sub Question');            

         return redirect()->route('questions.edit', ['category' => $id, 'question' => request('parent_id')]);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateQuestion  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestion $request, $id)
    {
        $question = Question::create([
            'question' => request('question'),
            'supervision_category_id' => $id,
            'question_type_id' => request('question_type_id'),
            'supervision_area_id' => request('supervision_area_id')
        ]);

        Session::flash('status', 'Successfully added question');            

        return redirect()->route('categories.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Question  $question
     * @param  SupervisionCategory $category
     * @return \Illuminate\Http\Response
     */
    public function edit(SupervisionCategory $category, Question $question)
    {
        $supareas = SupervisionArea::all();
        $questypes = QuestionType::all();

        $types = [];
        foreach($questypes as $questype){
            $types[$questype->id] = $questype->name;
        }

        $areas = [];
        foreach($supareas as $suparea){
            $areas[$suparea->id] = $suparea->name;
        }

        return view('categories.question-edit')->withAreas($areas)->withTypes($types)->withQuestion($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Question  $question
     * @param  SupervisionCategory $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupervisionCategory $category, Question $question)
    {
        //Validate the data
        $this->validate($request, array(
                'question' => 'required|string|min:5',
                'supervision_area_id' => 'nullable|integer'
            ));
        
        $question->question = $request->question;
        $question->supervision_category_id = $category->id;
        $question->supervision_area_id = $request->supervision_area_id;

        $question->save();

        Session::flash('status', 'Successfully Updated question');            

        return redirect()->route('categories.show', $category->id);
    }
}