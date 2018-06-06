<div class="col-lg-3 col-sm-6">
    <div class="card">
        <div class="content">
            <div class="numbers">
                @php
                    $yesLeadership = [];                                    
                    $noLeadership = []; 
                    
                    foreach ($facilities->take(6) as $key => $facility) {
                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                        if(isset($supervision)){
                            $transaction = $supervision->transactions->where('question_id', 157)->first();

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
                <p>Delivery Service Availability</p>
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
                        $supervision = $supervisions->where('supervision_category_id', 5)->where('facility_id', $facility->id)->sortByDesc('created_at')->first();

                        if(isset($supervision)){
                            $transaction = $supervision->transactions->where('question_id', 164)->first();

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
                <p>Emergency Referral Protocol</p>
                @include('home.partials.components._computePerc')
            </div>
        </div>
    </div>
</div>