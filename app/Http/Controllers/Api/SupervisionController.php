<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Supervision;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSupervision;

use App\Subscriber;
use App\Notifications\SupervisionAutoResponse;

class SupervisionController extends Controller
{
        /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSupervision  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSupervision $request)
    {   
        $collaborators = json_decode($request->collaborators);

        $answers = json_decode($request->answers);

        if(sizeof($answers) == 0 ){

            return response()->json(['message' => 'Please Answer atleast one question'], 422);
            
        } else {
            
            $supervision = new Supervision;

            $supervision->supervision_category_id = $request->category;
            $supervision->facility_id = $request->facility;
            $supervision->user_id = Auth::user()->id;
            $supervision->longitude = '2322342424';
            $supervision->latitude = '2342425232';
            
            $supervision->save();

            $supervision->collaborators()->sync($collaborators, false);

            foreach ($answers as $answer) {

                $transaction = new Transaction();

                $transaction->answer = $answer->answer;
                $transaction->question_id = $answer->question_id;
                $transaction->supervision_id = $supervision->id;
                $transaction->save();
            }

            $subscribers = Subscriber::find(1);
            $subscriber->notify(new SupervisionAutoResponse($supervision, $subscriber));
        }

        $response['message'] = 'Supervision Completed Successfully';
        
        return response()->json($response);
    }
}