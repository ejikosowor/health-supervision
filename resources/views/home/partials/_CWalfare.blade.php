<div class="col-lg-6 col-sm-6">
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="numbers">
                        @php
                            $yesLeadership = [];                                    
                            $noLeadership = []; 
                            
                            foreach ($facilities->take(6) as $key => $facility) {
                                $supervision = $supervisions->where('supervision_category_id', 10)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                if(isset($supervision)){
                                    $transaction = $supervision->transactions->where('question_id', 345)->first();

                                    if(isset($transaction['answer'])){
                                        if($transaction['answer'] == 1){
                                            $yesLeadership[] = $transaction;                                                    
                                        } else {
                                            $noLeadership[] = $transaction;
                                        }
                                    }
                                }
                            }
                        @endphp
                        <p>Anthropometric assessment for under-fives</p>
                        @include('home.partials.components._computePerc')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="numbers">
                        @php
                            $yesLeadership = [];                                    
                            $noLeadership = []; 
                            
                            foreach ($facilities->take(6) as $key => $facility) {
                                $supervision = $supervisions->where('supervision_category_id', 10)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                if(isset($supervision)){
                                    $transaction = $supervision->transactions->where('question_id', 360)->first();

                                    if(isset($transaction['answer'])){
                                        if($transaction['answer'] == 1){
                                            $yesLeadership[] = $transaction;                                                    
                                        } else {
                                            $noLeadership[] = $transaction;
                                        }
                                    }
                                }
                            }
                        @endphp
                        <p>Twice a Day Temperature Monitoring Interval</p>
                        @include('home.partials.components._computePerc')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="numbers">
                        @php
                            $yesLeadership = [];                                    
                            $noLeadership = []; 
                            
                            foreach ($facilities->take(6) as $key => $facility) {
                                $supervision = $supervisions->where('supervision_category_id', 10)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                                if(isset($supervision)){
                                    $transaction = $supervision->transactions->where('question_id', 366)->first();

                                    if(isset($transaction['answer'])){
                                        if($transaction['answer'] == 1){
                                            $yesLeadership[] = $transaction;                                                    
                                        } else {
                                            $noLeadership[] = $transaction;
                                        }
                                    }
                                }
                            }
                        @endphp
                        <p>Updated Immunization Register and Tally sheets</p>
                        @include('home.partials.components._computePerc')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>