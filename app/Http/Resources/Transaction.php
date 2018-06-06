<?php

namespace App\Http\Resources;

use App\Transaction as QuestionTransaction;
use Illuminate\Http\Resources\Json\Resource;

class Transaction extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $transaction = QuestionTransaction::where(['question_id' => $this->question->id, 'supervision_id' => $this->supervision])->first();

        $result = [
            'S/N' => ($this->question->parent_id == null) ? $this->sn : '',
            'Question' => $this->question->question,
            'Answer' => 'Yes',
            'Question Type' => $this->question->type->name,
        ];

        switch($this->question->question_type_id):
            case (1):
                if(isset($transaction['answer'])){
                    if($transaction['answer'] == 1){
                        $result['Answer'] = 'Yes';
                    } else {
                        $result['Answer'] = 'No';
                    }
                } else {
                    $result['Answer'] = 'Not Answered';
                }
            break;
            case (2):
                if(isset($transaction['answer'])){
                    if($transaction['answer'] == 1){
                        $result['Answer'] = 'Yes';
                    } else {
                        $result['Answer'] = 'No';
                    }
                } else {
                    $result['Answer'] = 'Not Answered';
                }
            break;
            case (3):
                if(isset($transaction['answer'])){
                    $result['Answer'] = $transaction['answer'];
                } else {
                    $result['Answer'] = 'Not Answered';
                }
            break;
            case (4):
                $result['Answer'] = '';                
            break;
            case (5):
                $result['S/N'] = '';
                $result['Answer'] = '';                
            break;
        endswitch;

        return $result;
    }
}