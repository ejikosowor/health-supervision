<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="numbers">
                    @php
                        $yesLeadership = [];                                    
                        $noLeadership = []; 
                        
                        foreach ($facilities->take(6) as $key => $facility) {
                            $supervision = $supervisions->where('supervision_category_id', 1)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                            if(isset($supervision)){
                                $transaction = $supervision->transactions->where('question_id', 1)->first();

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
                    <p>Discussions and Meetings</p>
                    @include('home.partials.components._computePerc')
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="numbers">
                    @php
                        $yesLeadership = [];                                    
                        $noLeadership = []; 
                        
                        foreach ($facilities->take(6) as $key => $facility) {
                            $supervision = $supervisions->where('supervision_category_id', 1)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                            if(isset($supervision)){
                                $transaction = $supervision->transactions->where('question_id', 4)->first();

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
                    <p>Feedback Mechanism</p>
                    @include('home.partials.components._computePerc')
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="numbers">
                    @php
                        $yesLeadership = [];                                    
                        $noLeadership = []; 
                        
                        foreach ($facilities->take(6) as $key => $facility) {
                            $supervision = $supervisions->where('supervision_category_id', 1)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                            if(isset($supervision)){
                                $transaction = $supervision->transactions->where('question_id', 2)->first();

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
                    <p>Service Charter</p>
                    @include('home.partials.components._computePerc')
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="numbers">
                    @php
                        $yesLeadership = [];                                    
                        $noLeadership = []; 
                        
                        foreach ($facilities->take(6) as $key => $facility) {
                            $supervision = $supervisions->where('supervision_category_id', 1)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                            if(isset($supervision)){
                                $transaction = $supervision->transactions->where('question_id', 9)->first();

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
                    <p>Waste Disposal Guidline</p>
                    @include('home.partials.components._computePerc')
                </div>
            </div>
        </div>
    </div>
</div>