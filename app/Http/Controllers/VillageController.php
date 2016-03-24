<?php

namespace App\Http\Controllers;


use App\Village;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Repositories\VillageRepository;

class VillageController extends Controller
{
     /**
     * The Village repository instance.
     *
     * @var VillageRepository
     */
    protected $village;

    public function __construct(VillageRepository $village)
    {
        $this->middleware('auth');
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
