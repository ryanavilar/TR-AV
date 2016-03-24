<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Army;
use App\Village;

use App\Repositories\ArmyRepository;
use App\Repositories\VillageRepository;

class ArmyController extends Controller
{
     /**
     * The Army repository instance.
     *
     * @var ArmyRepository
     * @var VillageRepository
     */
    protected $army;
    protected $village;

    public function __construct(ArmyRepository $army, VillageRepository $village)
    {
        $this->middleware('auth');
        $this->army = $army;
        $this->village = $village;

    }

    /**
     * Display Village
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {   
        $parseArray = array(
                'upgradePrice' => $this->army->getUpgradePrice($request->user()),
                'status'    => $this->army->getStatus($request->user()),
            );
        return view('villages.army', [
            'army' => $this->army->forUser($request->user()),
            'village' =>$this->village->forUser($request->user()),
            'index' => 2,
        ])->with('data', $parseArray);
    }

    /**
     * Upgrade Army
     *
     * @param  Request  $request
     * @return Response
     */ 

    public function levelup(Request $request)
    {
        $this->army->levelup($request->user(),$request->type);
        return redirect('/army');
    }

    /**
     * Recruit Army
     *
     * @param  Request  $request
     * @return Response
     */ 

    public function recruit(Request $request)
    {
        $this->army->recruit($request->user(),$request->type);
        return redirect('/army');
    }
}
