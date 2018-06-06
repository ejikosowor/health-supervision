<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="numbers">
                    @php
                        $qOne = 0; 
                        $qTwo = 0; 
                        
                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();
                        
                        if(isset($supervision)){
                            $transaction1 = $supervision->transactions->where('question_id', 408)->first();
                            $transaction2 = $supervision->transactions->where('question_id', 409)->first();

                            if(isset($transaction1['answer'])){
                                $qOne = $transaction1['answer'];

                                if (isset($transaction2['answer'])){
                                    $qTwo = $transaction2['answer'];
                                }
                            }
                        }
                    @endphp
                    <p>Birth Weight &#8805; 2500g recieved care per MOH guidlines</p>
                    @include('facilities.analytics.partials.components._computePerc1')
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="numbers">
                    @php
                        $qOne = 0; 
                        $qTwo = 0; 
                        
                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();
                        
                        if(isset($supervision)){
                            $transaction1 = $supervision->transactions->where('question_id', 421)->first();
                            $transaction2 = $supervision->transactions->where('question_id', 422)->first();

                            if(isset($transaction1['answer'])){
                                $qOne = $transaction1['answer'];

                                if (isset($transaction2['answer'])){
                                    $qTwo = $transaction2['answer'];
                                }
                            }
                        }
                    @endphp
                    <p>Women with post-partum haemorrhage who recieved therapeutic uterotonic drugs</p>
                    @include('facilities.analytics.partials.components._computePerc1')
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="numbers">
                    @php
                        $qOne = 0; 
                        $qTwo = 0; 
                        
                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();
                        
                        if(isset($supervision)){
                            $transaction1 = $supervision->transactions->where('question_id', 423)->first();
                            $transaction2 = $supervision->transactions->where('question_id', 424)->first();

                            if(isset($transaction1['answer'])){
                                $qOne = $transaction1['answer'];

                                if (isset($transaction2['answer'])){
                                    $qTwo = $transaction2['answer'];
                                }
                            }
                        }
                    @endphp
                    <p>Women who recieved recommended anti-hipertensives</p>
                    @include('facilities.analytics.partials.components._computePerc1')
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="numbers">
                    @php
                        $qOne = 0; 
                        $qTwo = 0; 
                        
                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();
                        
                        if(isset($supervision)){
                            $transaction1 = $supervision->transactions->where('question_id', 421)->first();
                            $transaction2 = $supervision->transactions->where('question_id', 422)->first();

                            if(isset($transaction1['answer'])){
                                $qOne = $transaction1['answer'];

                                if (isset($transaction2['answer'])){
                                    $qTwo = $transaction2['answer'];
                                }
                            }
                        }
                    @endphp
                    <p>Women with post-partum haemorrhage who recieved therapeutic uterotonic drugs</p>
                    @include('facilities.analytics.partials.components._computePerc1')
                </div>
            </div>
        </div>
    </div>
</div>