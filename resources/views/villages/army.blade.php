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

            <h3 class="text-center">Current Army</h3>
            <h4 class="text-center"><img class="status"src="{{ asset('img/atk-icon.png') }}">Attack {{ ($data['status']['swordsman']['attack']*$army->swordsman)+($data['status']['archer']['attack']*$army->archer)+($data['status']['horseman']['attack']*$army->horseman) }} <img class="status" src="{{ asset('img/def.png') }}">Defence {{ ($data['status']['swordsman']['defence']*$army->swordsman)+($data['status']['archer']['defence']*$army->archer)+($data['status']['horseman']['defence']*$army->horseman) }}</h4>
            <hr>
            <div>
                @include('layouts.message')
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img class="army" src="{{ asset('img/swordsman.jpg') }}" alt="...">
                  <div class="caption">
                    <h3 class="pull-right">{{$army->swordsman}} 
                    @if ($army->swordsman < 2)
                    <small>unit</small></h3>
                    @else
                    <small>units</small></h3>
                    @endif</h3>
                    <h3>Swordsman <small>Lv {{$army->swordsmanLv}}</small></h3>                    
                    <p class="text-justify">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at,</p>

                    <h5><b><u>To The Next Level </u></b></h5>
                    <p>
                            <img id="icon-sm" src="{{ asset('img/wood-icon.png') }}"/>{{$data['upgradePrice']['swordsman']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['upgradePrice']['swordsman']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['upgradePrice']['swordsman']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['upgradePrice']['swordsman']['wheat']}}
                    </p>

                    <h5><b><u>Recruit For </u></b></h5>
                    <p>
                            <img id="icon-sm" src="{{ asset('img/wood-icon.png') }}"/>{{$data['status']['swordsman']['recruit']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['status']['swordsman']['recruit']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['status']['swordsman']['recruit']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['status']['swordsman']['recruit']['wheat']}}
                    </p>

                    <h5 class="pull-right"><img class="status"src="{{ asset('img/atk-icon.png') }}"> {{$army->swordsman*$data['status']['swordsman']['attack']}} <img class="status" src="{{ asset('img/def.png') }}"> {{$army->swordsman*$data['status']['swordsman']['defence']}}</h5>
                    
                    <a href="#" class="inline-please btn btn-primary" role="button">Details</a> 

                    @if ($village->barrackLv > $army->swordsmanLv )
                    <form action="/armyLvlUp" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="swordsman" />
                    <button type="submit" class="btn btn-default" role="button">Train</button>
                    </form>
                    @else 
                    <button type="submit" class="btn btn-disabled inline-please" role="button" data-toggle="tooltip" data-placement="bottom" title="Upgrade Barrack to Train More">Train</button>
                    @endif


                    <form action="/recruit" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="swordsman" />
                    <button type="submit" class="btn btn-default" role="button">Recruit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img class="army" src="{{ asset('img/archer.jpg') }}" alt="...">
                  <div class="caption">
                    <h3 class="pull-right">{{$army->archer}} 
                    @if ($army->archer < 2)
                    <small>unit</small></h3>
                    @else
                    <small>units</small></h3>
                    @endif
                    <h3>Archer <small>Lv {{$army->archerLv}}</small> </h3>
                    <p class="text-justify">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at,</p>

                    <h5><b><u>To The Next Level </u></b></h5>
                    <p>
                            
                            <img id="icon-sm" src="{{ asset('img/wood-icon.png') }}"/>{{$data['upgradePrice']['archer']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['upgradePrice']['archer']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['upgradePrice']['archer']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['upgradePrice']['archer']['wheat']}}
                    </p>

                    <h5><b><u>Recruit For </u></b></h5>
                    <p>
                            <img id="icon-sm" src="{{ asset('img/wood-icon.png') }}"/>{{$data['status']['archer']['recruit']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['status']['archer']['recruit']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['status']['archer']['recruit']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['status']['archer']['recruit']['wheat']}}
                    </p>
                    
                    <h5 class="pull-right"><img class="status"src="{{ asset('img/atk-icon.png') }}"> {{$army->archer*$data['status']['archer']['attack']}} <img class="status" src="{{ asset('img/def.png') }}"> {{$army->archer*$data['status']['archer']['defence']}}</h5>
                    
                    <a href="#" class="inline-please btn btn-primary" role="button">Details</a> 


                    @if ($village->barrackLv > $army->archerLv )
                    <form action="/armyLvlUp" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="archer" />
                    <button type="submit" class="btn btn-default" role="button">Train</button>
                    </form>
                    @else 
                    <button type="submit" class="btn btn-disabled inline-please" role="button" data-toggle="tooltip" data-placement="bottom" title="Upgrade Barrack to Train More">Train</button>
                    @endif

                    <form action="/recruit" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="archer" />
                    <button type="submit" class="btn btn-default" role="button">Recruit</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img class="army" src="{{ asset('img/horseman.jpg') }}"alt="...">
                  <div class="caption">
                    <h3 class="pull-right">{{$army->horseman}}  
                    @if ($army->archer < 2)
                    <small>unit</small></h3>
                    @else
                    <small>units</small></h3>
                    @endif
                    </h3>
                    <h3>Horseman <small>Lv {{$army->horsemanLv}} </small></h3>
                    <p class="text-justify">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at,</p>
                    
                    <h5><b><u>To The Next Level </u></b></h5>
                    <p>
                            <img id="icon-sm" src="{{ asset('img/wood-icon.png') }}"/>{{$data['upgradePrice']['horseman']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['upgradePrice']['horseman']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['upgradePrice']['horseman']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['upgradePrice']['horseman']['wheat']}}
                    </p>

                    <h5><b><u>Recruit For </u></b></h5>
                    <p>
                            <img id="icon-sm" src="{{ asset('img/wood-icon.png') }}"/>{{$data['status']['horseman']['recruit']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['status']['horseman']['recruit']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['status']['horseman']['recruit']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['status']['horseman']['recruit']['wheat']}}
                    </p>
                    <h5 class="pull-right"><img class="status"src="{{ asset('img/atk-icon.png') }}"> {{$army->horseman*$data['status']['horseman']['attack']}} <img class="status" src="{{ asset('img/def.png') }}"> {{$army->horseman*$data['status']['horseman']['defence']}}</h5>
                    
                    <a href="#" class="inline-please btn btn-primary" role="button">Details</a> 


                    @if ($village->barrackLv > $army->horsemanLv )
                    <form action="/armyLvlUp" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="horseman" />
                    <button type="submit" class="btn btn-default" role="button">Train</button>
                    </form>
                    @else 
                    <button type="submit" class="btn btn-disabled inline-please" role="button" data-toggle="tooltip" data-placement="bottom" title="Upgrade Barrack to Train More">Train</button>
                    @endif

                    <form action="/recruit" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="horseman" />
                    <button type="submit" class="btn btn-default" role="button">Recruit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- row -->

    <hr>

              

</div>
</div>
</div>


<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
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
</script>
@endsection