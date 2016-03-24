<?php

namespace App\Repositories;

use App\User;
use App\Army;
use App\Village;
use Session;
class ArmyRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Army::where('user_id', $user->id)->first();
    }

    public function levelup(User $user,$type){
        $village = Village::where('user_id', $user->id)->first();
        $army = Army::where('user_id', $user->id)->first();
        $upgradePrice = $this->getUpgradePrice($user);
        if($this->possibleUpgrade($upgradePrice,$village,$type)) {    
            switch ($type) {
                case 'swordsman':
                $army->swordsmanLv++;
                $village->Wood  -= $upgradePrice['swordsman']['wood'];
                $village->Stone -= $upgradePrice['swordsman']['stone'];
                $village->Soil -= $upgradePrice['swordsman']['soil'];
                $village->Wheat -= $upgradePrice['swordsman']['wheat'];
                $village->save();
                $army->save();
                break;

                case 'horseman':
                $army->horsemanLv++;
                $village->Wood  -= $upgradePrice['horseman']['wood'];
                $village->Stone -= $upgradePrice['horseman']['stone'];
                $village->Soil -= $upgradePrice['horseman']['soil'];
                $village->Wheat -= $upgradePrice['horseman']['wheat'];
                $village->save();
                $army->save();
                break;

                case 'archer':
                $army->archerLv++;
                $village->Wood  -= $upgradePrice['archer']['wood'];
                $village->Stone -= $upgradePrice['archer']['stone'];
                $village->Soil -= $upgradePrice['archer']['soil'];
                $village->Wheat -= $upgradePrice['archer']['wheat'];
                $village->save();
                $army->save();
                break;
            }
        }else{

            Session::flash('message', 'Lack of Resources!'); 
            Session::flash('alert-class', 'alert-danger'); 
        }
    }

    public function recruit(User $user, $type){
       $village = Village::where('user_id', $user->id)->first();
       $army = Army::where('user_id', $user->id)->first();
       $status = $this->getStatus($user);
       if($this->possibleRecruit($status,$village,$type)) {    
        switch ($type) {
            case 'swordsman':
            $army->swordsman++;
            $village->Wood  -= $status['swordsman']['recruit']['wood'];
            $village->Stone -= $status['swordsman']['recruit']['stone'];
            $village->Soil -= $status['swordsman']['recruit']['soil'];
            $village->Wheat -= $status['swordsman']['recruit']['wheat'];
            $village->save();
            $army->save();
            break;

            case 'horseman':
            $army->horseman++;
            $village->Wood  -= $status['horseman']['recruit']['wood'];
            $village->Stone -= $status['horseman']['recruit']['stone'];
            $village->Soil -= $status['horseman']['recruit']['soil'];
            $village->Wheat -= $status['horseman']['recruit']['wheat'];
            $village->save();
            $army->save();
            break;

            case 'archer':
            $army->archer++;
            $village->Wood  -= $status['archer']['recruit']['wood'];
            $village->Stone -= $status['archer']['recruit']['stone'];
            $village->Soil -= $status['archer']['recruit']['soil'];
            $village->Wheat -= $status['archer']['recruit']['wheat'];
            $village->save();
            $army->save();
            break;
        }
    }else{

        Session::flash('message', 'Lack of Resources!'); 
        Session::flash('alert-class', 'alert-danger'); 
    }
}

public function getStatus(User $user){
    $army = Army::where('user_id', $user->id)->first();
    return $status = array(
        'swordsman' => array(
            'attack' => $this->powerAccumulate(10,$army->swordsmanLv),
            'defence' => $this->powerAccumulate(10,$army->swordsmanLv),
            'buildTime' => 3,
            'recruit' => array(
                'wood' => $this->recruitPriceAccumulate(50,$army->swordsmanLv),
                'wheat' => $this->recruitPriceAccumulate(50,$army->swordsmanLv),
                'stone' => $this->recruitPriceAccumulate(50,$army->swordsmanLv),
                'soil' => $this->recruitPriceAccumulate(50,$army->swordsmanLv),
                ),
            ),
        'archer' => array(
            'attack' => $this->powerAccumulate(10,$army->archerLv),
            'defence' => $this->powerAccumulate(25,$army->archerLv),
            'buildTime' => 4,
            'recruit' => array(
                'wood' => $this->recruitPriceAccumulate(50,$army->archerLv),
                'wheat' => $this->recruitPriceAccumulate(50,$army->archerLv),
                'stone' => $this->recruitPriceAccumulate(50,$army->archerLv),
                'soil' => $this->recruitPriceAccumulate(50,$army->archerLv),
                ),
            ),
        'horseman' => array(
            'attack' => $this->powerAccumulate(25,$army->horsemanLv),
            'defence' => $this->powerAccumulate(15,$army->horsemanLv),
            'buildTime' => 5,
            'recruit' => array(
                'wood' => $this->recruitPriceAccumulate(50,$army->horsemanLv),
                'wheat' => $this->recruitPriceAccumulate(50,$army->horsemanLv),
                'stone' => $this->recruitPriceAccumulate(50,$army->horsemanLv),
                'soil' => $this->recruitPriceAccumulate(50,$army->horsemanLv),
                ),
            ),
        );
}


public function getUpgradePrice(User $user){
    $army = Army::where('user_id', $user->id)->first();
    return $upgradePrice = array(
        'swordsman' => array(
            'wood' => $this->upgradePriceAccumulate(200,$army->swordsmanLv),
            'stone' => $this->upgradePriceAccumulate(200,$army->swordsmanLv),
            'soil' => $this->upgradePriceAccumulate(200,$army->swordsmanLv),
            'wheat' => $this->upgradePriceAccumulate(200,$army->swordsmanLv),
            ),
        'archer' => array(
            'wood' => $this->upgradePriceAccumulate(200,$army->archerLv),
            'stone' => $this->upgradePriceAccumulate(200,$army->archerLv),
            'soil' => $this->upgradePriceAccumulate(200,$army->archerLv),
            'wheat' => $this->upgradePriceAccumulate(200,$army->archerLv)
            ),
        'horseman' => array(
            'wood' => $this->upgradePriceAccumulate(200,$army->horsemanLv),
            'stone' => $this->upgradePriceAccumulate(200,$army->horsemanLv),
            'soil' => $this->upgradePriceAccumulate(200,$army->horsemanLv),
            'wheat' => $this->upgradePriceAccumulate(200,$army->horsemanLv)
            ),
        );
}

function upgradePriceAccumulate($basicPrice,$armyLv){
    return ($armyLv == 1)?$basicPrice:floor($basicPrice*(1.5**($armyLv-1)));
}

function recruitPriceAccumulate($basicPrice,$armyLv){
    return ($armyLv == 1)?$basicPrice:floor($basicPrice*(1.5**($armyLv-1)));
}

function powerAccumulate($basicPower,$armyLv){
   if($armyLv == 1){
    return $basicPower;
}
$accumulate = 0;
$accumulator = 1.5;
for($i =1; $i < $armyLv; $i++){
    $accumulate+= $basicPower*$accumulator;
    if($i < 10){
        $decrease = 1/10;
    }else{
        $decrease = 1/100;
    }
    $accumulator -= $decrease;
}
return floor($accumulate);
}

function possibleUpgrade($upgradePrice,$village,$army){
    if(($village->Wood >= $upgradePrice[$army]['wood']) && ($village->Stone >= $upgradePrice[$army]['stone']) && ($village->Soil >= $upgradePrice[$army]['soil']) && ($village->Wheat >= $upgradePrice[$army]['wheat'])){
        return true;
    }else{
        return false;
    }
}

function possibleRecruit($status,$village,$army){
    if(($village->Wood >= $status[$army]['recruit']['wood']) && ($village->Stone >= $status[$army]['recruit']['stone']) && ($village->Soil >= $status[$army]['recruit']['soil']) && ($village->Wheat >= $status[$army]['recruit']['wheat'])){
        return true;
    }else{
        return false;
    }
}
}