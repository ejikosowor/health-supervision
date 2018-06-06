<?php

namespace App\Http\Controllers\Supervision;

use Auth;
use Event;
use Session;
use App\Facility;
use App\Supervision;
use App\Transaction;
use Illuminate\Http\Request;
use App\SupervisionCategory;
use App\Http\Controllers\Controller;

use App\Subscriber;
use App\Notifications\SupervisionAutoResponse;

class SupervisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = SupervisionCategory::all();        
        $supervisions = Supervision::with('category')->where('facility_id', Auth::user()->facility_id)->get();
        
        return view('online-supervisions.index')->withCategories($categories)->withSupervisions($supervisions);        
    }    
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  SupervisionCategory $category
     * @return \Illuminate\Http\Response
     */
    public function create(SupervisionCategory $category)
    {
        return view('online-supervisions.create')->withCategory($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  SupervisionCategory $category
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SupervisionCategory $category)
    {   
        $answers = array_filter($request->answers, 'strlen');
        
        if(Auth::user()->role_id != 4) {

            Session::flash('error', 'Sorry Only Health Representatives can carry out supervisions');            

        } else if(Auth::user()->facility_id == null) {

            Session::flash('error', 'Sorry Supervision Cannot be completed at this time. You are not assigned a health facility');           

        } else {

            $supervision = new Supervision;

            $supervision->supervision_category_id = $category->id;
            $supervision->facility_id = Auth::user()->facility_id;
            $supervision->user_id = Auth::user()->id;
            $supervision->longitude = '2322342424';
            $supervision->latitude = '2342425232';
            
            $supervision->save();

            foreach ($answers as $key => $value) {

                $transaction = new Transaction();
                
                if($value == 'on') {
                    $transaction->answer = 1;                    
                } else {
                    $transaction->answer = $value;
                }                
                $transaction->question_id = $key;
                $transaction->supervision_id = $supervision->id;
                $transaction->save();
            }           

            $subscribers = Subscriber::find(1);
            $subscriber->notify(new SupervisionAutoResponse($supervision, $subscriber));

            Session::flash('status', 'Supervision successfully completed');            
        }        
        
        return redirect()->route('online-supervisions.index');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $supervision = Auth::user()->supervisions()->findOrFail($id);

        $transactions = Transaction::where('supervision_id', $supervision->id)->get();
        
        return view('online-supervisions.single')->withSupervision($supervision)->withTransactions($transactions);
    }
}