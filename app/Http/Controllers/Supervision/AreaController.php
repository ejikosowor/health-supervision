<?php

namespace App\Http\Controllers\Supervision;

use Session;
use App\SupervisionArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArea;

class AreaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateArea $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArea $request)
    {
        $question = SupervisionArea::create([
            'name' => request('area-name')
        ]);

        Session::flash('status', 'Successfully added New Area');            

        return redirect()->route('categories.index');
    }
}
