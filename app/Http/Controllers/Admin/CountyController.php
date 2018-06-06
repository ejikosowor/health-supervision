<?php

namespace App\Http\Controllers\Admin;

use App\County;
use App\Facility;
use App\SubCounty;
use App\SupervisionCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counties = County::all()->sortByDesc('id');

        return view('counties.index')->withCounties($counties);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $county = County::findOrFail($id);
        $categories = SupervisionCategory::all();

        return view('counties.single')->withCounty($county)->withCategories($categories);
    }

    /**
     * Display the specified resource.
     *
     * @param  County  $county
     * @param  int $subcounty
     * @return \Illuminate\Http\Response
     */
    public function showSubCounty(County $county, int $subcounty)
    {

        $SubCounty = $county->subcounties->where('id', $subcounty)->first();

        $facilities = Facility::with('county', 'owner', 'type')->where('sub_county_id', $SubCounty->id)->get();

        if($SubCounty != null){
            return view('counties.facilities')->withSubCounty($SubCounty)->withFacilities($facilities);
        } else {
            abort(404);
        }
    }
}