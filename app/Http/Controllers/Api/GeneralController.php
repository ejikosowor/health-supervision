<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\Facility;
use App\Supervision;
use Illuminate\Http\Request;
use App\SupervisionCategory;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = SupervisionCategory::with(array('questions'=>function($query){
            $query->select('id','question', 'supervision_category_id', 'question_type_id')
                    ->where('parent_id', null)
                    ->with('subQuestions');
        }))->get();

        $data['facilities'] = Facility::select('id', 'name')->get();

        $data['supervisors'] = User::select('id', 'name')->where('role_id', 2)->get()->except(Auth::user()->id);

        $data['supervisions'] =  Supervision::with('transactions')->where('user_id', Auth::user()->id)->get();

        return $data;        
    }
}