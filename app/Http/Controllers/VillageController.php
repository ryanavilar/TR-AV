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
     * @var TaskRepository
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
        //print_r($this->village->forUser($request->user()));
        return view('villages.home', [
            'village' => $this->village->forUser($request->user()),
            'index' => 1,
        ]);
    }
}
