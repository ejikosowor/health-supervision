<?php

namespace App\Http\Controllers\Admin;

use Excel;
use Carbon\Carbon;
use App\Transaction;
use App\Supervision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction as TransactionResource;

class SupervisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisions = Supervision::with('facility', 'category', 'supervisor')->get();

        return view('supervision.index')->withSupervisions($supervisions);
    }

    /**
     * Display the specified resource.
     *
     * @param  Supervision $supervision
     * @return \Illuminate\Http\Response
     */
    public function show(Supervision $supervision)
    {
        $transactions = Transaction::where('supervision_id', $supervision->id)->get();

        return view('supervision.single')->withSupervision($supervision)->withTransactions($transactions);       
    }

    /**
     * Download the specified resource.
     *
     * @param  Supervision $supervision
     * @return \Illuminate\Http\Response
     */
    public function download(Supervision $supervision)
    {
        $allData;
        $loop_iteration = 0;
        $previous_iteration = 0;
        $current_iteration;
        $sn;

        foreach ($supervision->category->questions as $key => $question) {
            $loop_iteration++;

            if($question->parent_id == null){
                if($question->question_type_id == 5){
                    $sn = $previous_iteration;
                } else {
                    if(isset($previous_iteration)){
                        $previous_iteration++;
                        $sn = $previous_iteration;
                    } else {
                        $sn = $loop_iteration;
                        $previous_iteration = $loop_iteration;
                    }
                }
            } else {
                $sn = $previous_iteration;
            }

            $allData[] = new \StdClass;
            $allData[$key]->sn = $sn;
            $allData[$key]->question = $question;
            $allData[$key]->supervision = $supervision->id;
        }

        $collection = collect($allData)->each(function ($item, $key) {
            return (array) $item;
        });

        $transactions = TransactionResource::collection($collection);

        $dt = new Carbon($supervision->created_at);

        $data = $transactions->jsonSerialize();
        
        return Excel::create($supervision->category->name.' - '.$supervision->facility->name.' - '.$dt->toFormattedDateString(), function($excel) use ($data) {
            $excel->sheet('All Questions', function($sheet) use ($data){
                $sheet->fromArray($data);
            });
        })->download('xlsx');   
    }
}