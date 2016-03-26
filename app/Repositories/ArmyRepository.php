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

    public function getArmy($id)
    {
        $army = Army::where('user_id', $id)->first();
        return array(
                'army' => Army::where('user_id', $id)->first(),
                'swordsmanAtk' => $this->powerAccumulate(10,$army->swordsmanLv),
                'swordsmanDef' => $this->powerAccumulate(10,$army->swordsmanLv),
                'archerAtk' => $this->powerAccumulate(10,$army->archerLv),
                'archerDef' => $this->powerAccumulate(15,$army->archerLv),
                'horsemanAtk' => $this->powerAccumulate(25,$army->horsemanLv),
                'horsemanDef' => $this->powerAccumulate(15,$army->horsemanLv),
            );
    }

    public function attack(User $user,$enemyid)
    {
        $myarmy = Army::where('user_id', $user->id)->first();
        $enemyarmy = Army::where('user_id', $enemyid)->first();

        $enemyVillage = Village::where('user_id',$enemyid)->first();
        $myVillage = Village::where('user_id',$user->id)->first();

        $status = $this->getStatus($user);
        $enemy = $this->getArmy($enemyid);

        $myAttackPower = ($myarmy->swordsman*$status['swordsman']['attack'])+($myarmy->archer*$status['archer']['attack'])+($myarmy->horseman*$status['horseman']['attack']);
        $enemyDefensePower = ($enemy['army']->swordsman*$enemy['swordsmanDef'])+($enemy['army']->archer*$enemy['archerDef'])+($enemy['army']->horseman*$enemy['horsemanDef'] );

        //WIN
        if($myAttackPower > $enemyDefensePower){
            $damage = $myAttackPower - $enemyDefensePower;
            $totalEnemyArmy = $enemy['army']->swordsman + $enemy['army']->archer + $enemy['army']->horseman;

            $swordsmanDie = $enemyarmy->swordsman - floor((($enemy['army']->swordsman*$enemy['swordsmanDef'])/$damage)*$enemyarmy->swordsman);
            $archerDie = $enemyarmy->archer - floor((($enemy['army']->archer*$enemy['archerDef'])/$damage)*$enemyarmy->archer);
            $horsemanDie = $enemyarmy->horseman - floor((($enemy['army']->horseman*$enemy['horsemanDef'])/$damage)*$enemyarmy->horseman);

            $getWood = floor($enemyVillage->Wood*0.5);
            $getSoil = floor($enemyVillage->Soil*0.5);
            $getStone = floor($enemyVillage->Stone*0.5);
            $getWheat = floor($enemyVillage->Wheat*0.5);

            $enemyarmy->swordsman = floor((($enemy['army']->swordsman*$enemy['swordsmanDef'])/$damage)*$enemyarmy->swordsman);
            $enemyarmy->archer = floor((($enemy['army']->archer*$enemy['archerDef'])/$damage)*$enemyarmy->archer);
            $enemyarmy->horseman = floor((($enemy['army']->horseman*$enemy['horsemanDef'])/$damage)*$enemyarmy->horseman);
            $enemyarmy->save();

            $enemyVillage->Soil -= $getSoil;
            $enemyVillage->Wood -= $getWood;
            $enemyVillage->Stone -= $getStone;
            $enemyVillage->Wheat -= $getWheat;
            $enemyVillage->save();

            $myVillage->Soil += $getSoil;
            $myVillage->Wood += $getWood;
            $myVillage->Stone += $getStone;
            $myVillage->Wheat += $getWheat;
            $myVillage->save();

            return array(
                    'status' => true,
                    'enemyVillage' => $enemyVillage,
                    'enemySwordsmanDie' => $swordsmanDie,
                    'enemyArcherDie' => $archerDie,
                    'enemyHorsemanDie' => $horsemanDie,
                    'getWood' => $getWood,
                    'getSoil' => $getSoil,
                    'getStone' => $getStone,
                    'getWheat' => $getWheat,
                );
        }

        //LOSE
        else{
            $damage = $enemyDefensePower - $myAttackPower;            
            $totalMyArmy = $myarmy->swordsman + $myarmy->archer + $myarmy->horseman;

            $swordsmanDie = $myarmy->swordsman - floor((($myarmy->swordsman*$status['swordsman']['attack'])/$damage)*$myarmy->swordsman);
            $archerDie = $myarmy->archer - floor((($myarmy->archer*$status['archer']['attack'])/$damage)*$myarmy->archer);
            $horsemanDie = $myarmy->horseman - floor((($myarmy->swordsman*$status['horseman']['attack'])/$damage)*$myarmy->horseman);

            $myarmy->swordsman = floor((($myarmy->swordsman*$status['swordsman']['attack'])/$damage)*$myarmy->swordsman);
            $myarmy->archer = floor((($myarmy->archer*$status['archer']['attack'])/$damage)*$myarmy->archer);
            $myarmy->horseman = floor((($myarmy->swordsman*$status['horseman']['attack'])/$damage)*$myarmy->horseman);

            $myarmy->save();

            return array(
                    'status' => false,
                    'enemyVillage' => $enemyVillage,
                    'mySwordsmanDie' => $swordsmanDie,
                    'myArcherDie' => $archerDie,
                    'myHorsemanDie' => $horsemanDie,
                );
        }
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
            'nattack' => $this->powerAccumulate(10,$army->swordsmanLv+1),
            'ndefence' => $this->powerAccumulate(10,$army->swordsmanLv+1),
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
            'nattack' => $this->powerAccumulate(10,$army->archerLv+1),
            'ndefence' => $this->powerAccumulate(25,$army->archerLv+1),
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
            'nattack' => $this->powerAccumulate(25,$army->horsemanLv+1),
            'ndefence' => $this->powerAccumulate(15,$army->horsemanLv+1),
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
        $decrease = 1/100;
    }elseif($i < 100&& $i > 10){
        $decrease = 1/1000;
    }elseif($i < 1000&& $i > 100){
        $decrease = 1/10000;
    }else{
        $decrease = 1/100000;
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