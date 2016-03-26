@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($battleStatus['status'])
            <h1 class="text-center">You Win</h1>
            @if($battleStatus['enemyVillage']->isOverlord == 1)
            <h2 class="text-center">against {{$battleStatus['enemyVillage']->villageName}} <small>Kingdom</small></h2>
            @else
            <h2 class="text-center">against {{$battleStatus['enemyVillage']->villageName}} <small>Village</small></h2>
            @endif
            
            <h3 class="text-center"><u><b>Enemy Fallen Armies</b></u></h3>
            <div class="fallen row">
                    <div class="media col-md-4">
                      <div class="media-left media-middle">
                        <a href="#">
                          <img class="media-object" src="{{ asset('img/swordsman.jpg') }}" alt="swordsman">
                      </a>
                  </div>
                  <div class="media-body">
                      <h4 class="media-heading"><b>Swordsman</b></h4>
                    @if($battleStatus['enemySwordsmanDie']>2)
                      <h5 class="swordsmanUnit">{{$battleStatus['enemySwordsmanDie']}} Units</h5>
                      @else
                      <h5 class="swordsmanUnit">{{$battleStatus['enemySwordsmanDie']}} Unit</h5>
                      @endif
                  </div>
              </div>

              <div class="media col-md-4">
                  <div class="media-left media-middle">
                    <a href="#">
                      <img class="media-object" src="{{ asset('img/archer.jpg') }}" alt="archer">
                  </a>
              </div>
              <div class="media-body">
                <h4 class="media-heading"> <b>Archer </b></h4>
                    @if($battleStatus['enemyArcherDie']>2)
                <h5 class="archerUnit">{{$battleStatus['enemyArcherDie']}} Units</h5>
                @else
                <h5 class="archerUnit">{{$battleStatus['enemyArcherDie']}} Unit</h5>
                @endif
            </div>
            </div>

            <div class="media col-md-4">
              <div class="media-left media-middle">
                <a href="#">
                  <img class="media-object" src="{{ asset('img/horseman.jpg') }}" alt="horseman">
              </a>
              </div>
                <div class="media-body">
                    <h4 class="media-heading"><b>Horseman</b></h4>
                    @if($battleStatus['enemyHorsemanDie']>2)
                    <h5 class="horsemanUnit">{{$battleStatus['enemyHorsemanDie']}} Units</h5>
                        @else
                    <h5 class="horsemanUnit">{{$battleStatus['enemyHorsemanDie']}} Unit</h5>
                        @endif
                </div>
            </div>
        </div>


        <h3 class="text-center"><u><b>You Raided Resources</b></u></h3>
        <div class="fallen row">
                    <div class="media col-md-3">
                      <div class="media-left media-middle">
                        <a href="#">
                          <img class="media-object" src="{{ asset('img/Wood-icon.png') }}" alt="swordsman">
                      </a>
                  </div>
                  <div class="media-body">
                      <h4 class="media-heading"><b>Wood</b></h4>
                    @if($battleStatus['getWood']>2)
                      <h5 class="swordsmanUnit">{{$battleStatus['getWood']}} Units</h5>
                      @else
                      <h5 class="swordsmanUnit">{{$battleStatus['getWood']}} Unit</h5>
                      @endif
                  </div>
              </div>

              <div class="media col-md-3">
                  <div class="media-left media-middle">
                    <a href="#">
                      <img class="media-object" src="{{ asset('img/stone-icon.png') }}" alt="archer">
                  </a>
              </div>
              <div class="media-body">
                <h4 class="media-heading"> <b>Stone </b></h4>
                    @if($battleStatus['getStone']>2)
                <h5 class="archerUnit">{{$battleStatus['getStone']}} Units</h5>
                @else
                <h5 class="archerUnit">{{$battleStatus['getStone']}} Unit</h5>
                @endif
            </div>
            </div>

            <div class="media col-md-3">
              <div class="media-left media-middle">
                <a href="#">
                  <img class="media-object" src="{{ asset('img/soil-icon.png') }}" alt="horseman">
              </a>
              </div>
                <div class="media-body">
                    <h4 class="media-heading"><b>Soil</b></h4>
                    @if($battleStatus['getSoil']>2)
                    <h5 class="horsemanUnit">{{$battleStatus['getSoil']}} Units</h5>
                        @else
                    <h5 class="horsemanUnit">{{$battleStatus['getSoil']}} Unit</h5>
                        @endif
                </div>
            </div>

            <div class="media col-md-3">
                  <div class="media-left media-middle">
                    <a href="#">
                      <img class="media-object" src="{{ asset('img/wheat-icon.png') }}" alt="archer">
                  </a>
              </div>
              <div class="media-body">
                <h4 class="media-heading"> <b>Wheat </b></h4>
                    @if($battleStatus['getWheat']>2)
                <h5 class="archerUnit">{{$battleStatus['getWheat']}} Units</h5>
                @else
                <h5 class="archerUnit">{{$battleStatus['getWheat']}} Unit</h5>
                @endif
            </div>
            </div>
        </div>
            <hr>
            @else
            <h1 class="text-center">You Lost</h1>
            
            @if($battleStatus['enemyVillage']->isOverlord == 1)
            <h2 class="text-center">against {{$battleStatus['enemyVillage']->villageName}} <small>Kingdom</small></h2>
            @else
            <h2 class="text-center">against {{$battleStatus['enemyVillage']->villageName}} <small>Village</small></h2>
            @endif
            <hr>
            <h3 class="text-center"><b><u>Your Fallen Armies</u></b></h3>

                <div class="fallen row">

                    <div class="media col-md-4">
                      <div class="media-left media-middle">
                        <a href="#">
                          <img class="media-object" src="{{ asset('img/swordsman.jpg') }}" alt="swordsman">
                      </a>
                  </div>
                  <div class="media-body">
                      <h4 class="media-heading"><b>Swordsman</b></h4>
                    @if($battleStatus['mySwordsmanDie']>2)
                      <h5 class="swordsmanUnit">{{$battleStatus['mySwordsmanDie']}} Units</h5>
                      @else
                      <h5 class="swordsmanUnit">{{$battleStatus['mySwordsmanDie']}} Unit</h5>
                      @endif
                  </div>
              </div>

              <div class="media col-md-4">
                  <div class="media-left media-middle">
                    <a href="#">
                      <img class="media-object" src="{{ asset('img/archer.jpg') }}" alt="archer">
                  </a>
              </div>
              <div class="media-body">
                <h4 class="media-heading"> <b>Archer </b></h4>
                    @if($battleStatus['myArcherDie']>2)
                <h5 class="archerUnit">{{$battleStatus['myArcherDie']}} Units</h5>
                @else
                <h5 class="archerUnit">{{$battleStatus['myArcherDie']}} Unit</h5>
                @endif
            </div>
            </div>

            <div class="media col-md-4">
              <div class="media-left media-middle">
                <a href="#">
                  <img class="media-object" src="{{ asset('img/horseman.jpg') }}" alt="horseman">
              </a>
              </div>
                <div class="media-body">
                    <h4 class="media-heading"><b>Horseman</b></h4>
                    @if($battleStatus['myHorsemanDie']>2)
                    <h5 class="horsemanUnit">{{$battleStatus['myHorsemanDie']}} Units</h5>
                        @else
                    <h5 class="horsemanUnit">{{$battleStatus['myHorsemanDie']}} Unit</h5>
                        @endif
                </div>
            </div>

        </div>
    </div>

@endif

<br>

<div class="text-center row">
    <a href="/maps" class="btn btn-sm btn-default">Back To Maps</a>
    <a href="/main" class="btn btn-sm btn-default">See Your Village</a>
    <a href="/army" class="btn btn-sm btn-default">See Your Army</a>
</div>


</div>
</div>
</div>


@endsection