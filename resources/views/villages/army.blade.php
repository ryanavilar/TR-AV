@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="topbar">
            <p class="pull-right" id="clock">Time</p>
            <ul class="resources">
                <li> <img src="{{ asset('img/Wood-icon.png') }}"/> <strong> Wood : </strong> {{ $village->Wood }}/<strong>{{$village->warehouseLv*500 }}</strong> </li>
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
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$data['upgradePrice']['swordsman']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['upgradePrice']['swordsman']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['upgradePrice']['swordsman']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['upgradePrice']['swordsman']['wheat']}}
                    </p>


                    @if ($army->swordsmanLv > 0)
                    <h5><b><u>Recruit For </u></b></h5>
                    <p>
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$data['status']['swordsman']['recruit']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['status']['swordsman']['recruit']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['status']['swordsman']['recruit']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['status']['swordsman']['recruit']['wheat']}}
                    </p>
                    @endif

                    <h5 class="pull-right"><img class="status"src="{{ asset('img/atk-icon.png') }}"> {{$army->swordsman*$data['status']['swordsman']['attack']}} <img class="status" src="{{ asset('img/def.png') }}"> {{$army->swordsman*$data['status']['swordsman']['defence']}}</h5>
                    
                    <a href="#" id="swordsman"class="details inline-please btn btn-primary" role="button" data-toggle="modal" data-target="#DetailsModal">Details</a> 

                    @if ($village->barrackLv > $army->swordsmanLv )
                    <form action="/armyLvlUp" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="swordsman" />
                    <button type="submit" class="btn btn-default" role="button">Train</button>
                    </form>
                    @else 
                    <button type="submit" class="btn btn-disabled inline-please" role="button" data-toggle="tooltip" data-placement="bottom" title="Upgrade Barrack to Train More">Train</button>
                    @endif

                    @if ($army->swordsmanLv > 0)
                    <form action="/recruit" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="swordsman" />
                    <button type="submit" class="btn btn-default" role="button">Recruit</button>
                    </form>
                    @else
                    <button type="submit" class="btn btn-disabled inline-please" role="button" data-toggle="tooltip" data-placement="bottom" title="Train Swordsman First">Recruit</button>
                    @endif

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
                            
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$data['upgradePrice']['archer']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['upgradePrice']['archer']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['upgradePrice']['archer']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['upgradePrice']['archer']['wheat']}}
                    </p>


                    @if ($army->archerLv > 0)
                    <h5><b><u>Recruit For </u></b></h5>
                    <p>
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$data['status']['archer']['recruit']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['status']['archer']['recruit']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['status']['archer']['recruit']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['status']['archer']['recruit']['wheat']}}
                    </p>
                    @endif
                    
                    <h5 class="pull-right"><img class="status"src="{{ asset('img/atk-icon.png') }}"> {{$army->archer*$data['status']['archer']['attack']}} <img class="status" src="{{ asset('img/def.png') }}"> {{$army->archer*$data['status']['archer']['defence']}}</h5>
                    
                    <a href="#" id="archer" class="details inline-please btn btn-primary" role="button" data-toggle="modal" data-target="#DetailsModal">Details</a> 


                    @if ($village->barrackLv > $army->archerLv )
                    <form action="/armyLvlUp" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="archer" />
                    <button type="submit" class="btn btn-default" role="button">Train</button>
                    </form>
                    @else 
                    <button type="submit" class="btn btn-disabled inline-please" role="button" data-toggle="tooltip" data-placement="bottom" title="Upgrade Barrack to Train More">Train</button>
                    @endif

                    @if ($army->archerLv > 0)
                    <form action="/recruit" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="archer" />
                    <button type="submit" class="btn btn-default" role="button">Recruit</button>
                    </form>
                    @else
                    <button type="submit" class="btn btn-disabled inline-please" role="button" data-toggle="tooltip" data-placement="bottom" title="Train Archer First">Recruit</button>
                    @endif

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
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$data['upgradePrice']['horseman']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['upgradePrice']['horseman']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['upgradePrice']['horseman']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['upgradePrice']['horseman']['wheat']}}
                    </p>


                    @if ($army->horsemanLv > 0)
                    <h5><b><u>Recruit For </u></b></h5>
                    <p>
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$data['status']['horseman']['recruit']['wood']}}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$data['status']['horseman']['recruit']['stone']}}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$data['status']['horseman']['recruit']['soil']}}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$data['status']['horseman']['recruit']['wheat']}}
                    </p>
                    @endif

                    <h5 class="pull-right"><img class="status"src="{{ asset('img/atk-icon.png') }}"> {{$army->horseman*$data['status']['horseman']['attack']}} <img class="status" src="{{ asset('img/def.png') }}"> {{$army->horseman*$data['status']['horseman']['defence']}}</h5>
                    
                    <a href="#" id="horseman" class="inline-please details btn btn-primary" role="button" data-toggle="modal" data-target="#DetailsModal">Details</a> 


                    @if ($village->barrackLv > $army->horsemanLv )
                    <form action="/armyLvlUp" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="horseman" />
                    <button type="submit" class="btn btn-default" role="button">Train</button>
                    </form>
                    @else 
                    <button type="submit" class="btn btn-disabled inline-please" role="button" data-toggle="tooltip" data-placement="bottom" title="Upgrade Barrack to Train More">Train</button>
                    @endif


                    @if ($army->horsemanLv > 0)
                    <form action="/recruit" method="POST" class="inline-please">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" value="horseman" />
                    <button type="submit" class="btn btn-default" role="button">Recruit</button>
                    </form>
                    @else
                    <button type="submit" class="btn btn-disabled inline-please" role="button" data-toggle="tooltip" data-placement="bottom" title="Train Horseman First">Recruit</button>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- row -->

    <hr>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="DetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Details Army</h4>
    </div>
    <div class="modal-body">
        <img id="img-details">
        <h3 id="heading-details"> </h3>
        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 

        <h4><u>Status</u> :</h4>
        <p id="statusModal">
        </p> 

        <h4><u>Total Power :</u> :</h4>
        <p id="power">
        </p> 

        <h4><u>Next Upgrade Effects</u> :</h4>
        <p id="effects">
        </p> 

        <h4><u>To Recruit More</u> :</h4>
        <ul id="recneed" class="resources">
        </ul>

        <h4><u>Upgrade Requirements</u> :</h4>
        <ul id="need" class="resources">
        </ul>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>


<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

     $('.details').click(function(){
        var id = $(this).attr('id');
        var str;
        var img;
        var wood,stone,soil,wheat;
        var woodUp,stoneUp,soilUp,wheatUp;
        var effects,status,power;
        switch(id){
            case 'swordsman':
            str = " Lv {{ $army->swordsmanLv }}";
            id="Swordsman";
            img = "{{ asset('img/swordsman.jpg') }}";
            wood = "{{$data['status']['swordsman']['recruit']['wood'] }}";
            stone = "{{$data['status']['swordsman']['recruit']['stone'] }}";
            soil = "{{$data['status']['swordsman']['recruit']['soil'] }}";
            wheat = "{{$data['status']['swordsman']['recruit']['wheat'] }}";
            woodUp = "{{$data['upgradePrice']['swordsman']['wood'] }}";
            stoneUp = "{{$data['upgradePrice']['swordsman']['stone'] }}";
            soilUp = "{{$data['upgradePrice']['swordsman']['soil'] }}";
            wheatUp = "{{$data['upgradePrice']['swordsman']['wheat'] }}";
            status = '<img class="status"src="{{ asset("img/atk-icon.png") }}"> {{$data["status"]["swordsman"]["attack"]}} <img class="status" src="{{ asset("img/def.png") }}"> {{$data["status"]["swordsman"]["defence"]}} <span class="badge">{{$army->swordsman}} {{($army->swordsman == 1)?"Unit":"Units"}}</span>';
            power = '<img class="status"src="{{ asset("img/atk-icon.png") }}"> {{$army->swordsman*$data["status"]["swordsman"]["attack"]}} <img class="status" src="{{ asset("img/def.png") }}"> {{$army->swordsman*$data["status"]["swordsman"]["defence"]}}';
            effects = '<img class="status"src="{{ asset("img/atk-icon.png") }}"> {{$data["status"]["swordsman"]["nattack"]}} <img class="status" src="{{ asset("img/def.png") }}"> {{$data["status"]["swordsman"]["ndefence"]}}';
            break;

            case 'archer':
            str = " Lv {{ $army->archerLv }}";
            id="Archer";
            img = "{{ asset('img/archer.jpg') }}"
            wood = "{{$data['status']['archer']['recruit']['wood'] }}";
            stone = "{{$data['status']['archer']['recruit']['stone'] }}";
            soil = "{{$data['status']['archer']['recruit']['soil'] }}";
            wheat = "{{$data['status']['archer']['recruit']['wheat'] }}";
            woodUp = "{{$data['upgradePrice']['archer']['wood'] }}";
            stoneUp = "{{$data['upgradePrice']['archer']['stone'] }}";
            soilUp = "{{$data['upgradePrice']['archer']['soil'] }}";
            wheatUp = "{{$data['upgradePrice']['archer']['wheat'] }}";
            effects = '<img class="status"src="{{ asset("img/atk-icon.png") }}"> {{$data["status"]["archer"]["nattack"]}} <img class="status" src="{{ asset("img/def.png") }}"> {{$data["status"]["archer"]["ndefence"]}}  ';
            status = '<img class="status"src="{{ asset("img/atk-icon.png") }}"> {{$data["status"]["archer"]["attack"]}} <img class="status" src="{{ asset("img/def.png") }}"> {{$data["status"]["archer"]["defence"]}}  <span class="badge">{{$army->archer}} {{($army->archer == 1)?"Unit":"Units"}}</span>';
            power = '<img class="status"src="{{ asset("img/atk-icon.png") }}"> {{$army->archer*$data["status"]["archer"]["attack"]}} <img class="status" src="{{ asset("img/def.png") }}"> {{$army->archer*$data["status"]["archer"]["defence"]}}';
            break;


            case 'horseman':
            str = " Lv {{ $army->horsemanLv }}";
            id="Horseman";
            img = "{{ asset('img/horseman.jpg') }}";
            wood = "{{$data['status']['horseman']['recruit']['wood'] }}";
            stone = "{{$data['status']['horseman']['recruit']['stone'] }}";
            soil = "{{$data['status']['horseman']['recruit']['soil'] }}";
            wheat = "{{$data['status']['horseman']['recruit']['wheat'] }}";
            woodUp = "{{$data['upgradePrice']['horseman']['wood'] }}";
            stoneUp = "{{$data['upgradePrice']['horseman']['stone'] }}";
            soilUp = "{{$data['upgradePrice']['horseman']['soil'] }}";
            wheatUp = "{{$data['upgradePrice']['horseman']['wheat'] }}";
            effects = '<img class="status"src="{{ asset("img/atk-icon.png") }}"> {{$data["status"]["horseman"]["nattack"]}} <img class="status" src="{{ asset("img/def.png") }}"> {{$data["status"]["horseman"]["ndefence"]}}';
            status = '<img class="status"src="{{ asset("img/atk-icon.png") }}"> {{$data["status"]["horseman"]["attack"]}} <img class="status" src="{{ asset("img/def.png") }}"> {{$data["status"]["horseman"]["defence"]}} <span class="badge">{{$army->horseman}} {{($army->horseman == 1)?"Unit":"Units"}}</span>';
            power = '<img class="status"src="{{ asset("img/atk-icon.png") }}"> {{$army->horseman*$data["status"]["horseman"]["attack"]}} <img class="status" src="{{ asset("img/def.png") }}"> {{$army->horseman*$data["status"]["horseman"]["defence"]}}';
            break;
        }

        var need = '<li> <img src="{{ asset('img/Wood-icon.png') }}"/> <strong> Wood : </strong> '+ wood +' </li>'          +'<li> <img src="{{ asset('img/stone-icon.png') }}"/> <strong> Stone : </strong> '+ stone +'</li>'
        +'<li> <img src="{{ asset('img/soil-icon.png') }}"/> <strong> Soil : </strong>'+soil+'</li>'
        +'<li> <img src="{{ asset('img/wheat-icon.png') }}"/> <strong> Wheat : </strong>'+wheat+'</li>';
        var needUp = '<li> <img src="{{ asset('img/Wood-icon.png') }}"/> <strong> Wood : </strong> '+ woodUp +' </li>'          +'<li> <img src="{{ asset('img/stone-icon.png') }}"/> <strong> Stone : </strong> '+ stoneUp +'</li>'
        +'<li> <img src="{{ asset('img/soil-icon.png') }}"/> <strong> Soil : </strong>'+soilUp+'</li>'
        +'<li> <img src="{{ asset('img/wheat-icon.png') }}"/> <strong> Wheat : </strong>'+wheatUp+'</li>';
        $('#need').html(needUp);
        $('#recneed').html(need);
        $('#effects').html(effects);
        $('#power').html(power);
        $('#statusModal').html(status);
        $('#heading-details').html(id+" <small>"+ str + " </small>");
        $('#img-details').attr("src",img);
    });


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