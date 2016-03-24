<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Village;
use App\Army;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/main';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $json = json_encode($user);
        $json = json_decode($json);
        
        $village = Village::create([
            'barrackLv' => 1,
            'warehouseLv' => 1,
            'hallLv' => 1,
            'lumberLv' =>1,
            'wheatLv' => 1,
            'quarryLv' => 1,
            'soilLv' => 1,
            'Wood' => 500,
            'Stone' => 500,
            'Soil' => 500,
            'Wheat' => 500,
            'user_id' => $json->id,
        ]);

        $army = Army::create([
            'archer' => 0,
            'swordsman' => 0,
            'horseman' => 0,
            'archerLv' => 0,
            'swordsmanLv' => 0,
            'horsemanLv' => 0,
            'user_id' => $json->id,
        ]);
        //print_r($village);
        //print_r($json->id);
        return $user;
    }
}
