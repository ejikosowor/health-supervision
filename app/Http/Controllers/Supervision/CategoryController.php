<?php

namespace App\Http\Controllers\Supervision;

use Session;
use App\Question;
use App\QuestionType;
use App\SupervisionArea;
use App\SupervisionCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supcat = SupervisionCategory::all();

        return view('categories.index')->withCategories($supcat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategory $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategory $request)
    {
        $question = SupervisionCategory::create([
            'name' => request('name')
        ]);

        Session::flash('status', 'Successfully added New Category');            

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  SupervisionCategory $category
     * @return \Illuminate\Http\Response
     */
    public function show(SupervisionCategory $category)
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

        return view('categories.single')->withCategory($category)->withAreas($areas)->withTypes($types);        
    }
}
