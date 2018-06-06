@php
    $sum = count($yesLeadership)+count($noLeadership);
    $per = round(count($yesLeadership)/$sum*100);
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