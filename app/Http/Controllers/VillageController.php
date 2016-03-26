<?php

namespace App\Http\Controllers;


use App\Village;
use App\Army;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Repositories\VillageRepository;
use App\Repositories\ArmyRepository;


class VillageController extends Controller
{
     /**
     * The Village repository instance.
     *
     * @var VillageRepository
     */
    protected $village;
    protected $army;

    public function __construct(VillageRepository $village, ArmyRepository $army)
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
        return view('villages.home', [
            'village' => $this->village->forUser($request->user()),
            'index' => 1,
        ])->with('upPrice', $this->village->getUpgradePrice($request->user()));
    }

    /**
     * Display Village
     *
     * @param  Request  $request
     * @return Response
     */
    public function maps(Request $request)
    {
        $parseArray = array(
                'upgradePrice' => $this->army->getUpgradePrice($request->user()),
                'status'    => $this->army->getStatus($request->user()),
            );
        return view('villages.maps', [
            'army' => $this->army->forUser($request->user()),
            'village' => $this->village->forUser($request->user()),
            'villages' => $this->village->allVillage(),
            'index' => 3,
        ])->with('data',$parseArray );
    }

    /**
     * Upgrade Village
     *
     * @param  Request  $request
     * @return Response
     */ 

    public function levelup(Request $request)
    {
        $this->village->levelup($request->user(),$request->type);
        return redirect('/main');
    }

    public function changeName(Request $request)
    {
        $this->village->changeName($request->user(),$request->name);
        return redirect('/main');
    }
}
