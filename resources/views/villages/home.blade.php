@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="pull-right" id="clock">Time</p>
            <ul class="resources">
                <li> <img src="{{ asset('img/Wood-icon.png') }}"/> <strong> Wood : </strong> {{ $village->Wood }}/<strong>{{$village->warehouseLv*500 }}</strong> </li>
                <li> <img src="{{ asset('img/stone-icon.png') }}"/> <strong> Stone : </strong> {{ $village->Stone }}/<strong>{{$village->warehouseLv*500 }}</strong></li>
                <li> <img src="{{ asset('img/soil-icon.png') }}"/> <strong> Soil : </strong>{{ $village->Soil }}/ <strong>{{$village->warehouseLv*500 }}</strong></li>
                <li> <img src="{{ asset('img/wheat-icon.png') }}"/> <strong> Wheat : </strong>{{ $village->Wheat }}/<strong>{{$village->warehouseLv*500 }}</strong></li>
            </ul>
            <div class="text-center">
                <form action="/change" method="POST"> {{ csrf_field() }}
                <div class="name">
                @if($village->isOverlord == 1)
                <h2> {{ $village->villageName }} <small>Kingdom</small> </h2>
                @else
                <h2> {{ $village->villageName }} <small>Village</small> </h2>
                @endif
                </div>
                </form>
                <a href="#" id="changeName" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Change Name</a>
            </div>

            <hr>
            <div>
                @include('layouts.message')
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/cityhall.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                    <h4 class="media-heading"> <strong> City Hall </strong> | Lv {{ $village->hallLv }} </h4> 
                    <h5>All Building Upgradable to Lvl {{ $village->hallLv }}</h5>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" id="City Hall" data-toggle="modal" data-target="#DetailsModal" class="floatleft details btn btn-sm btn-default">Details</a>

                    <form action="/lvlup" method="POST" class="floatleft">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="hall" />
                        <button class="btn btn-sm btn-default">Upgrade for
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$upPrice['hall']['wood'] }}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$upPrice['hall']['stone'] }}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$upPrice['hall']['soil'] }}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$upPrice['hall']['wheat'] }}
                        </button>
                    </form>

                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/warehouse.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                    <h4 class="media-heading"><strong> Warehouse </strong> | Lv {{ $village->warehouseLv }}</h4> 
                    <h5>All Resources can be hold up to {{ $village->warehouseLv*500 }}</h5>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" id="Warehouse" data-toggle="modal" data-target="#DetailsModal" class="floatleft details btn btn-sm btn-default">Details</a>

                    @if ($village->hallLv > $village->warehouseLv)
                    <form action="/lvlup" method="POST" class="floatleft">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="warehouse" />
                        <button class="btn btn-sm btn-default">Upgrade for
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$upPrice['warehouse']['wood'] }}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$upPrice['warehouse']['stone'] }}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$upPrice['warehouse']['soil'] }}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$upPrice['warehouse']['wheat'] }}
                        </button>
                    </form>
                    @else
                    <button class="btn btn-sm btn-default" disabled> Upgrade City Hall to Continue </button>
                    </button>
                    @endif

                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/barrack.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                    <h4 class="media-heading"><strong> Barrack </strong> | Lv {{ $village->barrackLv }}</h4> 
                    <h5>Your Armies Upgradable to Lvl {{ $village->barrackLv }}</h5>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" id="Barrack" data-toggle="modal" data-target="#DetailsModal" class="floatleft details btn btn-sm btn-default">Details</a>


                    @if ($village->hallLv > $village->barrackLv)
                    <form action="/lvlup" method="POST" class="floatleft">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="barrack" />
                        <button class="btn btn-sm btn-default">Upgrade for
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$upPrice['barrack']['wood'] }}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$upPrice['barrack']['stone'] }}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$upPrice['barrack']['soil'] }}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$upPrice['barrack']['wheat'] }}
                        </button>
                    </form>
                    @else
                    <button class="btn btn-sm btn-default" disabled> Upgrade City Hall to Continue </button>
                    </button>
                    @endif

                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/lumber.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                    <h4 class="media-heading"><strong> Lumber Mill | Lv {{ $village->lumberLv }}</strong></h4> 
                    <h5><img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/> {{ 350 + ($village->lumberLv)*150 }} / hour</h5>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" id="Lumber Mill" data-toggle="modal" data-target="#DetailsModal" class="floatleft details btn btn-sm btn-default">Details</a>

                    @if ($village->hallLv > $village->lumberLv)
                    <form action="/lvlup" method="POST" class="floatleft">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="lumber" />
                        <button type="submit" class="btn btn-sm btn-default">Upgrade for
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$upPrice['lumber']['wood'] }}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$upPrice['lumber']['stone'] }}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$upPrice['lumber']['soil'] }}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$upPrice['lumber']['wheat'] }}
                        </button>
                    </form>
                    @else
                    <button class="btn btn-sm btn-default" disabled> Upgrade City Hall to Continue </button>
                    </button>
                    @endif

                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/quarry.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                    <h4 class="media-heading"><strong> Quarry | Lv {{ $village->quarryLv }}</strong></h4> 
                    <h5><img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/> {{ 350 + ($village->quarryLv)*150 }} / hour</h5>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" id="Quarry" data-toggle="modal" data-target="#DetailsModal" class="floatleft details btn btn-sm btn-default">Details</a>

                    @if ($village->hallLv > $village->quarryLv)
                    <form action="/lvlup" method="POST" class="floatleft">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="quarry" />
                        <button class="btn btn-sm btn-default">Upgrade for
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$upPrice['quarry']['wood'] }}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$upPrice['quarry']['stone'] }}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$upPrice['quarry']['soil'] }}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$upPrice['quarry']['wheat'] }}
                        </button>
                    </form>
                    @else
                    <button class="btn btn-sm btn-default" disabled> Upgrade City Hall to Continue </button>
                    </button>
                    @endif

                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/soil.jpg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                    <h4 class="media-heading"><strong> Soil Source | Lv {{ $village->soilLv }}</strong></h4> 
                    <h5><img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/> {{ 350 + ($village->soilLv)*150 }} / hour</h5>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" id="Soil Source" data-toggle="modal" data-target="#DetailsModal" class="floatleft details btn btn-sm btn-default">Details</a>

                    @if ($village->hallLv > $village->soilLv)
                    <form action="/lvlup" method="POST" class="floatleft">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="soil" />
                        <button class="btn btn-sm btn-default">Upgrade for
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$upPrice['soil']['wood'] }}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$upPrice['soil']['stone'] }}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$upPrice['soil']['soil'] }}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$upPrice['soil']['wheat'] }}
                        </button>
                    </form>
                    @else
                    <button class="btn btn-sm btn-default" disabled> Upgrade City Hall to Continue </button>
                    </button>
                    @endif

                </div> 
            </div>

            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ asset('img/wheat.jpeg') }}" data-holder-rendered="true"> </a> 
                </div> 
                <div class="media-body"> 
                    <h4 class="media-heading"><strong> Wheat Field | Lv {{ $village->wheatLv }}</strong></h4> 
                    <h5><img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/> {{ 350 + ($village->wheatLv)*150 }} / hour</h5>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
                    <a href="#" id="Wheat Field" data-toggle="modal" data-target="#DetailsModal" class="floatleft details btn btn-sm btn-default">Details</a>

                    @if ($village->hallLv > $village->wheatLv)
                    <form action="/lvlup" method="POST" class="floatleft">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="wheat" />
                        <button class="btn btn-sm btn-default">Upgrade for
                            <img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/>{{$upPrice['wheat']['wood'] }}
                            <img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/>{{$upPrice['wheat']['stone'] }}
                            <img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/>{{$upPrice['wheat']['soil'] }}
                            <img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/>{{$upPrice['wheat']['wheat'] }}
                        </button>
                    </form>
                    @else
                    <button class="btn btn-sm btn-default" disabled> Upgrade City Hall to Continue </button>
                    </button>
                    @endif

                </div> 
            </div>



        </div>
    </div>
    
    <hr>

</div>


<!-- Modal -->
<div class="modal fade" id="DetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Details Building</h4>
    </div>
    <div class="modal-body">
        <img id="img-details">
        <h3 id="heading-details"> </h3>
        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p> 
        <h4><u>Next Upgrade Effects</u> :</h4>

        <p id="effects">
        </p> 

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

<script>

var hold;
    $('#changeName').click(function(){
        $hold = $('.name').html();
        $('.name').html(
            '<div class="form-group">'
            +'<input type="text" class="form-control form-extra" placeholder="Village Name" name="name" value="{{$village->villageName}}">'
            + '</div>'
            +'<input type="submit" class="btn btn-default btn-sm "/>'
            + '<a class="btn btn-default btn-sm" id="cancel" onclick="backToDefault()"> Cancel </a>'
        );
        $('#changeName').hide();
    });

    function backToDefault(){
        $('.name').html(
            "<h2> {{ $village->villageName }} <small>Village</small> </h2>"
        );
        $('#changeName').show();
    }

    $('.details').click(function(){
        var id = $(this).attr('id');
        var str;
        var img;
        var wood;
        var stone;
        var soil;
        var wheat;
        var effects;
        switch(id){
            case 'City Hall':
            str = " Lv {{ $village->hallLv }}";
            img = "{{ asset('img/cityhall.jpg') }}";
            wood = "{{$upPrice['hall']['wood'] }}";
            stone = "{{$upPrice['hall']['stone'] }}";
            soil = "{{$upPrice['hall']['soil'] }}";
            wheat = "{{$upPrice['hall']['wheat'] }}";
            effects = "Building Upgradable to Lvl {{ $village->hallLv+1 }}";
            break;

            case 'Warehouse':
            str = " Lv {{ $village->warehouseLv }}";
            img = "{{ asset('img/warehouse.jpg') }}"
            wood = "{{$upPrice['warehouse']['wood'] }}";
            stone = "{{$upPrice['warehouse']['stone'] }}";
            soil = "{{$upPrice['warehouse']['soil'] }}";
            wheat = "{{$upPrice['warehouse']['wheat'] }}";
            effects = "Storage increase to : {{ $village->warehouseLv*500 }}";
            break;


            case 'Barrack':
            str = " Lv {{ $village->barrackLv }}";
            img = "{{ asset('img/barrack.jpg') }}";
            wood = "{{$upPrice['barrack']['wood'] }}";
            stone = "{{$upPrice['barrack']['stone'] }}";
            soil = "{{$upPrice['barrack']['soil'] }}";
            wheat = "{{$upPrice['barrack']['wheat'] }}";
            effects = "Armies Lv upgradable to : {{ $village->barrackLv*500 }}";
            break;


            case 'Lumber Mill':
            str = " Lv {{ $village->lumberLv }}";
            img = "{{ asset('img/lumber.jpg') }}";
            wood = "{{$upPrice['lumber']['wood'] }}";
            stone = "{{$upPrice['lumber']['stone'] }}";
            soil = "{{$upPrice['lumber']['soil'] }}";
            wheat = "{{$upPrice['lumber']['wheat'] }}";
            effects = '<img id="icon-sm" src="{{ asset('img/Wood-icon.png') }}"/> Wood increase per hour become : {{ 350 + ($village->lumberLv+1)*150 }}';
            break;


            case 'Quarry':
            str = " Lv {{ $village->quarryLv }}";
            img = "{{ asset('img/quarry.jpg') }}";
            wood = "{{$upPrice['quarry']['wood'] }}";
            stone = "{{$upPrice['quarry']['stone'] }}";
            soil = "{{$upPrice['quarry']['soil'] }}";
            wheat = "{{$upPrice['quarry']['wheat'] }}";
            effects = '<img id="icon-sm" src="{{ asset('img/stone-icon.png') }}"/> Stone increase per hour become : {{ 350 + ($village->quarryLv+1)*150 }}';
            break;


            case 'Wheat Field':
            str = " Lv {{ $village->wheatLv }}";
            img = "{{ asset('img/wheat.jpeg') }}";
            wood = "{{$upPrice['wheat']['wood'] }}";
            stone = "{{$upPrice['wheat']['stone'] }}";
            soil = "{{$upPrice['wheat']['soil'] }}";
            wheat = "{{$upPrice['wheat']['wheat'] }}";
            effects = '<img id="icon-sm" src="{{ asset('img/wheat-icon.png') }}"/> Wheat increase per hour become : {{ 350 + ($village->wheatLv+1)*150 }}';
            break;


            case 'Soil Source':
            str = " Lv {{ $village->soilLv }}";
            img = "{{ asset('img/soil.jpg') }}";
            wood = "{{$upPrice['soil']['wood'] }}";
            stone = "{{$upPrice['soil']['stone'] }}";
            soil = "{{$upPrice['soil']['soil'] }}";
            wheat = "{{$upPrice['soil']['wheat'] }}";
            effects = '<img id="icon-sm" src="{{ asset('img/soil-icon.png') }}"/> Soil increase per hour become : {{ 350 + ($village->soilLv+1)*150 }}';
            break;
        }

        var need = '<li> <img src="{{ asset('img/Wood-icon.png') }}"/> <strong> Wood : </strong> '+ wood +' </li>'          +'<li> <img src="{{ asset('img/stone-icon.png') }}"/> <strong> Stone : </strong> '+ stone +'</li>'
        +'<li> <img src="{{ asset('img/soil-icon.png') }}"/> <strong> Soil : </strong>'+soil+'</li>'
        +'<li> <img src="{{ asset('img/wheat-icon.png') }}"/> <strong> Wheat : </strong>'+wheat+'</li>';
        $('#need').html(need);
        $('#effects').html(effects);
        $('#heading-details').html(id+" <small>"+ str + " </small>");
        $('#img-details').attr("src",img);
        console.log(id);
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
@endsection
