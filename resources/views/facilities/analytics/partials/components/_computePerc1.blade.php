@php
	if($qTwo != 0 && $qOne != 0){
		$per = round($qTwo/$qOne*100);
    } else {
        $per = 1;
    }
@endphp

@switch($per)
    @case($per == 75 || $per > 75)
        <span class="text-success">{{ $per.'%' }}</span>
    @break

    @case($per < 50)
        <span class="text-danger">{{ $per.'%' }}</span>
    @break

    @case($per == 50 || ($per > 50 && $per < 75))
        <span class="text-warning">{{ $per.'%' }}</span>
    @break

@endswitch