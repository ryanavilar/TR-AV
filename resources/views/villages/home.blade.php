@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="pull-right" id="clock">Time</p>
            <ul class="resources">
                <li> <img src="{{ asset('img/wood-icon.png') }}"/> <strong> Wood : </strong> {{ $village->Wood }}/{{$village->warehouseLv*500 }} </li>
                <li> <img src="{{ asset('img/stone-icon.png') }}"/> <strong> Stone : </strong> {{ $village->Stone }}/{{$village->warehouseLv*500 }}</li>
                <li> <img src="{{ asset('img/soil-icon.png') }}"/> <strong> Soil : </strong>{{ $village->Soil }}/{{$village->warehouseLv*500 }}</li>
                <li> <img src="{{ asset('img/wheat-icon.png') }}"/> <strong> Wheat : </strong>{{ $village->Wheat }}/{{$village->warehouseLv*500 }}</li>
            </ul>
            <div class="text-center">
            <h2> {{ $village->villageName }} <small>Village</small> </h2> 
            <a href="#" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Change Name</a>
            </div>

            <hr>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/cityhall.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                <h4 class="media-heading"> <strong> City Hall </strong> | Lv {{ $village->hallLv }} </h4> 
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" class="btn btn-sm btn-default">Details</a>
                    <a href="#" class="btn btn-sm btn-default">Upgrade</a>
                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/warehouse.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                <h4 class="media-heading"><strong> Warehouse </strong> | Lv {{ $village->warehouseLv }}</h4> 
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" class="btn btn-sm btn-default">Details</a>
                    <a href="#" class="btn btn-sm btn-default">Upgrade</a>
                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/barrack.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                <h4 class="media-heading"><strong> Barrack </strong> | Lv {{ $village->barrackLv }}</h4> 
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" class="btn btn-sm btn-default">Details</a>
                    <a href="#" class="btn btn-sm btn-default">Upgrade</a>
                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/lumber.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                <h4 class="media-heading"><strong> Lumber Mill | Lv {{ $village->lumberLv }}</strong></h4> 
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" class="btn btn-sm btn-default">Details</a>
                    <a href="#" class="btn btn-sm btn-default">Upgrade</a>
                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/quarry.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                <h4 class="media-heading"><strong> Quarry | Lv {{ $village->quarryLv }}</strong></h4> 
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" class="btn btn-sm btn-default">Details</a>
                    <a href="#" class="btn btn-sm btn-default">Upgrade</a>
                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/soil.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                <h4 class="media-heading"><strong> Soil Source | Lv {{ $village->soilLv }}</strong></h4> 
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" class="btn btn-sm btn-default">Details</a>
                    <a href="#" class="btn btn-sm btn-default">Upgrade</a>
                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/wheat.jpeg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                <h4 class="media-heading"><strong> Wheat Field | Lv {{ $village->wheatLv }}</strong></h4> 
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" class="btn btn-sm btn-default">Details</a>
                    <a href="#" class="btn btn-sm btn-default">Upgrade</a>
                </div> 
            </div>



        </div>
    </div>
    
    <hr>

</div>

<script>

    var now = new Date(<?php echo time() * 1000 ?>);
    function startInterval(){  
        setInterval('updateTime();', 1000);  
    }
    startInterval();//start it right away
    function updateTime(){
        var nowMS = now.getTime();
        nowMS += 1000;
        now.setTime(nowMS);
        var clock = document.getElementById('clock');
        if(clock){
            clock.innerHTML = now.toTimeString();//adjust to suit
        }
    } 
</script>
@endsection
