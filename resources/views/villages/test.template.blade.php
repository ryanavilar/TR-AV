@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="topbar">
                <p class="pull-right" id="clock">Time</p>
                <ul class="resources">
                    <li> <img src="{{ asset('img/wood-icon.png') }}"/> <strong> Wood : </strong> {{ $village->Wood }}/<strong>{{$village->warehouseLv*500 }}</strong> </li>
                    <li> <img src="{{ asset('img/stone-icon.png') }}"/> <strong> Stone : </strong> {{ $village->Stone }}/<strong>{{$village->warehouseLv*500 }}</strong></li>
                    <li> <img src="{{ asset('img/soil-icon.png') }}"/> <strong> Soil : </strong>{{ $village->Soil }}/ <strong>{{$village->warehouseLv*500 }}</strong></li>
                    <li> <img src="{{ asset('img/wheat-icon.png') }}"/> <strong> Wheat : </strong>{{ $village->Wheat }}/<strong>{{$village->warehouseLv*500 }}</strong></li>
                </ul>
            </div>

            <div class="myArmy">
                <h3> My Army :</h3>
                <div class="row">

                   <div class="col-md-2">
                    <div class="thumbnail">
                      <img class="army" src="{{ asset('img/swordsman.jpg') }}" alt="...">
                      <div class="caption text-center">
                        <h3><strong>Swordsman</strong> <small>Lv {{$army->swordsmanLv}}</small> </h3>
                        <h3>{{$army->swordsman}} 
                            @if ($army->swordsman < 2)
                            <small>unit</small></h3>
                            @else
                            <small>units</small></h3>
                            @endif
                            <h4><img class="status"src="{{ asset('img/atk-icon.png') }}"> {{$army->swordsman*$data['status']['swordsman']['attack']}} <img class="status" src="{{ asset('img/def.png') }}"> {{$army->swordsman*$data['status']['swordsman']['defence']}}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="thumbnail">
                      <img class="army" src="{{ asset('img/archer.jpg') }}" alt="...">
                      <div class="caption text-center">
                        <h3><strong>Archer</strong> <br><small>Lv {{$army->archerLv}}</small> </h3>
                        <h3>{{$army->archer}} 
                            @if ($army->archer < 2)
                            <small>unit</small></h3>
                            @else
                            <small>units</small></h3>
                            @endif
                            <h4><img class="status"src="{{ asset('img/atk-icon.png') }}"> {{$army->archer*$data['status']['archer']['attack']}} <img class="status" src="{{ asset('img/def.png') }}"> {{$army->archer*$data['status']['archer']['defence']}}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="thumbnail">
                      <img class="army" src="{{ asset('img/horseman.jpg') }}" alt="...">
                      <div class="caption text-center">
                        <h3><strong>Horseman</strong> <br><small>Lv {{$army->horsemanLv}}</small> </h3>
                        <h3>{{$army->horseman}} 
                            @if ($army->horseman < 2)
                            <small>unit</small></h3>
                            @else
                            <small>units</small></h3>
                            @endif
                            <h4><img class="status"src="{{ asset('img/atk-icon.png') }}"> {{$army->horseman*$data['status']['horseman']['attack']}} <img class="status" src="{{ asset('img/def.png') }}"> {{$army->horseman*$data['status']['horseman']['defence']}}</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">

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