@extends('layouts.app')

@section('headersheets')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu1C5u0rxG9w3rpXfpkfL8_MCujXv2EU8&callback=initialize" type="text/javascript"></script>
<style>
    #map-canvas {
        margin: 0;
        padding: 0;
        height: 400px;
        max-width: none;
    }
    #map-canvas img {
        max-width: none !important;
    }
</style>
<script>
    function initialize() {        
        var latlng = new google.maps.LatLng({!! json_encode($facility->latitude) !!},{!! json_encode($facility->longitude) !!});

        // This is making the Geocode request
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status !== google.maps.GeocoderStatus.OK) {
                alert(status);
            }
            
            // This is checking to see if the Geoeode Status is OK before proceeding
            if (status == google.maps.GeocoderStatus.OK) {
                var address = (results[0].formatted_address);

                $( '#facility_add' ).text(address);

                var map = new google.maps.Map(document.getElementById("map-canvas"), {
                    center: latlng,
                    zoom: 17,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                var marker = new google.maps.Marker({
                    map: map,
                    position: latlng
                });
            }
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection

@section('pageheader')
<a class="navbar-brand" href="{{ route('facilities.index') }}">Facilities</a>
@endsection

@section('breadcrumbs')
<li><a href="{{ route('facilities.index') }}">Facilities</a></li>
<li class="active">{{ $facility->name }}</li>
@endsection

@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Supervisions Summary</h4>
                    <p class="category">By Category</p>
                </div>
                <div class="content">
                    <div id="supervisionsOverview" class="ct-chart"></div>
                    <div class="footer">
                        <hr>
                        <div class="stats"></div>
                        <div class="pull-right">
                            <a href="{{ route('facilities.analytics', $facility->id) }}"><b>VIEW MORE</b><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <facility-supervisions :supervisions="{{ $supervisions }}"></facility-supervisions>   
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Facility Information</h4>
                </div>
                <div class="content">
                    <dl class="dl-horizontal">
                        <dt>Facility Code:</dt>
                        <dd>{{ $facility->facility_code }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Facility Type:</dt>
                        <dd>{{ $facility->type->name }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Facility Owner:</dt>
                        <dd>{{ $facility->owner->name }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Facility County:</dt>
                        <dd>{{ $facility->county->name }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Facility Sub County:</dt>
                        @if($facility->sub_county_id == null)
                            <dd><span class="label label-danger">Not Set</span></dd>
                        @else
                            <dd>{{ $facility->subcounty->name }}</dd>
                        @endif
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Contact Person:</dt>
                        @if($facility->contact_name == null)
                            <dd><span class="label label-danger">Not Set</span></dd>
                        @else
                            <dd>{{ $facility->contact_person }}</dd>                            
                        @endif
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Contact Phone:</dt>
                        @if($facility->phone == null)
                            <dd><span class="label label-danger">Not Set</span></dd>
                        @else
                            <dd>{{ $facility->phone }}</dd>                            
                        @endif
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Contact Email:</dt>
                        @if($facility->email == null)
                            <dd><span class="label label-danger">Not Set</span></dd>
                        @else
                            <dd>{{ $facility->email }}</dd>                            
                        @endif
                    </dl>
                </div>
            </div>

            <!--Facility Map View  -->
            <div class="card">
                <div class="header">
                    <h4 class="title">Facility Location</h4>
                    <p class="category" id="facility_add"></p>
                </div>
                <div class="content" id="map-canvas"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footerscripts')
<script src="{{ asset('js/chartist-plugins/axis-title/chartist-plugin-axistitle.min.js') }}"></script>
<script>
    new Chartist.Bar('#supervisionsOverview', {
        labels: [
            @foreach($categories as $category)
                "{{ str_limit($category->name, 10) }}",
            @endforeach
        ],
        series: [
            @foreach($categories as $category)
                "{{ $category->supervisions->where('facility_id', $facility->id)->count() }}",
            @endforeach
        ]
    }, {
        distributeSeries: true,
        chartPadding: {
            top: 11,
            right: 0,
            bottom: 0,
            left: 0
        },
        axisY: {
            onlyInteger: true
        }
    });
</script>
@endsection