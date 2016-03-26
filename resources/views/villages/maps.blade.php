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

            <div class="maps">

                <div class="row">
                    <div class="col-md-4">
                        <h3 class="text-center">Selected Village</h3>
                        <hr>
                        <div class="first text-center">
                            <p> Pick Village From the Maps </p>
                        </div>
                        <div class="sel-village"hidden>
                        <div class="text-center">
                            <img id="pics" src=""/> 
                            <h3 class="vil-name "></h3>
                            <ul class="vil-resources">
                            </ul>
                            </div>
                            <h3>Their Army <small id="totalPower"></small></h3>
                            <div class="vil-army">

                                <div class="media">
                                  <div class="media-left media-middle">
                                    <a href="#">
                                      <img class="media-object" src="{{ asset('img/swordsman.jpg') }}" alt="swordsman">
                                  </a>
                              </div>
                              <div class="media-body">
                                <h4 class="media-heading"><b>Swordsman</b> <small id="swordsmanLv"> </small></h4>
                                <h5 class="swordsmanUnit"></h5>
                                    <p class="swordsmanPower"></p>
                                </div>
                            </div>

                            <div class="media">
                              <div class="media-left media-middle">
                                <a href="#">
                                  <img class="media-object" src="{{ asset('img/archer.jpg') }}" alt="archer">
                              </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"> <b>Archer </b><small id="archerLv"> </small></h4>
                            <h5 class="archerUnit"></h5>
                                <p class="archerPower"></p>
                            </div>
                        </div>

                        <div class="media">
                          <div class="media-left media-middle">
                            <a href="#">
                              <img class="media-object" src="{{ asset('img/horseman.jpg') }}" alt="horseman">
                          </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading"><b>Horseman</b> <small id="horsemanLv"> </small></h4>
                        <h5 class="horsemanUnit"></h5>
                            <p class="horsemanPower"></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8 text-center">

            <h3> Maps of The World :</h3>
            <hr>
            <table>
                @for($i = 1; $i < 26; $i++)
                @if($i%5 == 1)
                <tr>
                    @endif
                    {{--*/ $notVillage = true /*--}}
                    @foreach($villages as $v)
                    @if($i == $v->location)
                    <td class="village">
                        @if($v->isOverlord == 1)
                        <img src="{{ asset('img/overlord.png') }}"/> 
                        <h4><b>{{$v->villageName}} <small>Kingdom</small></b></h4>
                        @else
                        <img src="{{ asset('img/village.jpg') }}"/> 
                        <h4><b>{{$v->villageName}} <small>Village</small></b></h4>
                        @endif
                        @if($village->location == $v->location)

                        @if($v->isOverlord == 1)
                        <a href="/main" class="btn btn-sm btn-default">Go to My Kingdom</a>
                        @else
                        <a href="/main" class="btn btn-sm btn-default">Go to My Village</a>
                        @endif
                        @else
                        <a id="check" class="btn btn-sm btn-default inline-please" onclick="checkVillage({{$v}})">Check</a>
                        <form action="/attack" method="POST"class="inline-please">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$v->user_id}}">
                            <button type="submit" class="btn btn-sm btn-danger">Attack</button>
                        </form>
                        @endif
                        {{--*/ $notVillage = false /*--}}
                    </td>
                    @endif
                    @endforeach
                    @if($notVillage)
                    <td class="empty">
                        <img src="{{ asset('img/empty.gif') }}"/> 
                    </td>
                    @endif
                    @if($i%5 == 0)
                </tr>
                @endif
                @endfor
            </tr>
        </table>
    </div>
</div><!-- row -->
<hr>

</div>
</div>
</div>
</div>

<script type="text/javascript">

    var checkVillage = function(village){
        var vilreso = ' <li> <img src="{{ asset('img/wood-icon.png') }}"/> <strong> Wood : </strong>'+village.Wood+'</li>'+
        '<li> <img src="{{ asset('img/stone-icon.png') }}"/> <strong> Stone : </strong> '+village.Stone+'</li>' +
        '<li> <img src="{{ asset('img/soil-icon.png') }}"/> <strong> Soil : </strong>'+village.Soil+'</li>'+
        '<li> <img src="{{ asset('img/wheat-icon.png') }}"/> <strong> Wheat : </strong>'+village.Wheat+'</li>';

        if(village.isOverlord==1){
            $('#pics').attr('src',"{{ asset('img/overlord.png') }}");
            $('#pics').attr('class',"kingdom");
            $('.vil-name').html(village.villageName+'<small> Kingdom </small>');
        }else{
            $('#pics').attr('src',"{{ asset('img/village.jpg') }}");
            $('.vil-name').html(village.villageName+'<small> Village </small>');
        }

        $.get('http://localhost:8000/army/'+village.user_id,function(data){
            var army = data['army'];
            $('.first').hide();
            $('.vil-resources').html(vilreso);
            $('.sel-village').show();

            $('#swordsmanLv').html("Lv "+numberWithCommas(army.swordsmanLv));
            if(army.swordsman > 1){
                $('.swordsmanUnit').html(army.swordsman + " Units");
            }else{
                $('.swordsmanUnit').html(army.swordsman + " Unit");
            }
            $('.swordsmanPower').html('<img class="status"src="{{ asset('img/atk-icon.png') }}">' + numberWithCommas(army.swordsman*data['swordsmanAtk']) +' <img class="status" src="{{ asset('img/def.png') }}">'+
            numberWithCommas(army.swordsman*data['swordsmanDef']) );

            $('#archerLv').html("Lv " +numberWithCommas(army.archerLv));
            if(army.swordsman > 1){
                $('.archerUnit').html(army.archer + " Units");
            } else{
                $('.archerUnit').html(army.archer + " Unit");
            }
            $('.archerPower').html('<img class="status"src="{{ asset('img/atk-icon.png') }}">' + numberWithCommas(army.archer*data['archerAtk'])+' <img class="status" src="{{ asset('img/def.png') }}">'+
            numberWithCommas(army.archer*data['archerDef']) );

            $('#horsemanLv').html("Lv " + numberWithCommas(army.horsemanLv));
            if(army.swordsman > 1){
                $('.horsemanUnit').html(army.horseman + " Units");
            }else{
                $('.horsemanUnit').html(army.horseman + " Unit");                
            }
            $('.horsemanPower').html('<img class="status"src="{{ asset('img/atk-icon.png') }}">' + numberWithCommas(army.horseman*data['horsemanAtk']) +' <img class="status" src="{{ asset('img/def.png') }}">'+
            numberWithCommas(army.horseman*data['horsemanDef']));

            $('#totalPower').html(
                '<img class="status"src="{{ asset('img/atk-icon.png') }}">' + numberWithCommas(army.horseman*data['horsemanAtk']+army.swordsman*data['swordsmanAtk']+army.archer*data['archerAtk'])+' <img class="status" src="{{ asset('img/def.png') }}">'+ numberWithCommas(army.archer*data['archerDef']+army.swordsman*data['swordsmanDef']+army.horseman*data['horsemanDef']) 
            );
        });
}

    var now = new Date(<?php echo time() * 1000 ?>);
    function startInterval(){  
        setInterval('updateTime();', 1000);  
    }
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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