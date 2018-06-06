<?php

namespace App\Http\Controllers\Admin;

use App\County;
use App\Facility;
use App\Question;
use App\SubCounty;
use App\Designation;
use App\Supervision;
use App\SupervisionCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Facility::with('county', 'owner', 'type')->get();
        return view('facilities.index')->withFacilities($facilities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::all();
        $des = [];

        foreach ($designations as $designation) {   
            $des[$designation->id] = $designation->name;
        }

        $counties = County::all();
        $cou = [];

        foreach ($counties as $county) {   
            $cou[$county->id] = $county->name;
        }

        $subcounties = SubCounty::all();
        $subcou = [];

        foreach ($subcounties as $subcounty) {   
            $subcou[$subcounty->id] = $subcounty->name;
        }

        return view('facilities.create')->withDesignations($des)->withCounties($cou)->withSubCounties($subcou);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
                'name' => 'required|string|min:10|max:255|unique:facilities',
                'email' => 'required|string|email|max:255|unique:facilities',
                'phone' => 'required|min:10|max:10|unique:facilities',
                'facility_code' => 'required|string|min:3|unique:facilities',
                'contact_name' => 'required|string|min:10|unique:facilities',
                'contact_designation_id' => 'required|integer',
                'county_id' => 'required|integer',
                'sub_county_id' => 'required|integer',
                'longitude' => 'required|string|min:5',
                'latitude' => 'required|string|min:5'
            ));

        $facility = Facility::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'facility_code' => $request->facility_code,
            'contact_name' => $request->contact_name,
            'contact_designation_id' => $request->contact_designation_id,
            'county_id' => $request->county_id,
            'sub_county_id' => $request->sub_county_id,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facility = Facility::find($id);
        $categories = SupervisionCategory::all();
        $supervisions = Supervision::with('category', 'supervisor')->where('facility_id', $facility->id)->get();
        
        return view('facilities.single')->withFacility($facility)->withCategories($categories)->withSupervisions($supervisions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAnalytics($id)
    {
        $facility = Facility::find($id);
        $categories = SupervisionCategory::all();
        $supervisions = Supervision::with('category', 'supervisor')->where('facility_id', $facility->id)->get();
        $questions = Question::all();
        
        return view('facilities.analytics.single')
                ->withQuestions($questions)
                ->withFacility($facility)
                ->withCategories($categories)
                ->withSupervisions($supervisions);
    }
}