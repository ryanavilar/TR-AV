<?php

namespace App\Repositories;

use Session;
use App\User;
use App\Village;

class VillageRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Village::where('user_id', $user->id)->first();
    }

    public function allVillage()
    {
        return Village::all();
    }

    public function changeName(User $user,$name){
        $village = Village::where('user_id', $user->id)->first();
        $village->villageName = $name;
        $village->save();
    }

    public function levelup(User $user,$building){
        $village = Village::where('user_id', $user->id)->first();
        $upgradePrice = $this->getUpgradePrice($user);
        if($this->possibleLevelUp($upgradePrice,$village,$building)){
            switch ($building) {
                case 'hall':
                $village->hallLv++;
                $village->Wood  -= $upgradePrice['hall']['wood'];
                $village->Stone -= $upgradePrice['hall']['stone'];
                $village->Soil -= $upgradePrice['hall']['soil'];
                $village->Wheat -= $upgradePrice['hall']['wheat'];
                if($village->hallLv > 100){
                    $village->isOverlord = 1;
                }
                $village->save();
                break;
                case 'lumber':
                $village->lumberLv++;
                $village->Wood -= $upgradePrice['lumber']['wood'];
                $village->Stone -= $upgradePrice['lumber']['stone'];
                $village->Soil -= $upgradePrice['lumber']['soil'];
                $village->Wheat -= $upgradePrice['lumber']['wheat'];
                $village->save();
                break;
                case 'warehouse':
                $village->warehouseLv++;
                $village->Wood -= $upgradePrice['warehouse']['wood'];
                $village->Stone -= $upgradePrice['warehouse']['stone'];
                $village->Soil -= $upgradePrice['warehouse']['soil'];
                $village->Wheat -= $upgradePrice['warehouse']['wheat'];
                $village->save();
                break;
                case 'quarry':
                $village->quarryLv++;
                $village->Wood -= $upgradePrice['quarry']['wood'];
                $village->Stone -= $upgradePrice['quarry']['stone'];
                $village->Soil -= $upgradePrice['quarry']['soil'];
                $village->Wheat -= $upgradePrice['quarry']['wheat'];
                $village->save();
                break;
                case 'wheat':
                $village->wheatLv++;
                $village->Wood -= $upgradePrice['wheat']['wood'];
                $village->Stone -= $upgradePrice['wheat']['stone'];
                $village->Soil -= $upgradePrice['wheat']['soil'];
                $village->Wheat -= $upgradePrice['wheat']['wheat'];
                $village->save();
                break;
                case 'soil':
                $village->soilLv++;
                $village->Wood -= $upgradePrice['soil']['wood'];
                $village->Stone -= $upgradePrice['soil']['stone'];
                $village->Soil -= $upgradePrice['soil']['soil'];
                $village->Wheat -= $upgradePrice['soil']['wheat'];
                $village->save();
                break;
                case 'barrack':
                $village->barrackLv++;
                $village->Wood -= $upgradePrice['barrack']['wood'];
                $village->Stone -= $upgradePrice['barrack']['stone'];
                $village->Soil -= $upgradePrice['barrack']['soil'];
                $village->Wheat -= $upgradePrice['barrack']['wheat'];
                $village->save();
                break;
            }
        }else{
            Session::flash('message', 'Lack of Resources!'); 
            Session::flash('alert-class', 'alert-danger'); 
        }
    }

    public function getUpgradePrice(User $user){
        $village = Village::where('user_id', $user->id)->first(); 
        return $upgradePrice = array(
            'barrack' => array(
                'wood' => $this->upgradePriceAccumulate(200,$village->barrackLv),
                'stone' => $this->upgradePriceAccumulate(200,$village->barrackLv),
                'soil' => $this->upgradePriceAccumulate(200,$village->barrackLv),
                'wheat' => $this->upgradePriceAccumulate(200,$village->barrackLv),
                ),
            'hall' => array(
                'wood' => $this->upgradePriceAccumulate(200,$village->hallLv),
                'stone' => $this->upgradePriceAccumulate(200,$village->hallLv),
                'soil' => $this->upgradePriceAccumulate(200,$village->hallLv),
                'wheat' => $this->upgradePriceAccumulate(200,$village->hallLv),
                ),
            'warehouse' => array(
                'wood' => $this->upgradePriceAccumulate(200,$village->warehouseLv),
                'stone' => $this->upgradePriceAccumulate(200,$village->warehouseLv),
                'soil' => $this->upgradePriceAccumulate(200,$village->warehouseLv),
                'wheat' => $this->upgradePriceAccumulate(200,$village->warehouseLv),
                ),
            'lumber' => array(
                'wood' => $this->upgradePriceAccumulate(200,$village->lumberLv),
                'stone' => $this->upgradePriceAccumulate(200,$village->lumberLv),
                'soil' => $this->upgradePriceAccumulate(200,$village->lumberLv),
                'wheat' => $this->upgradePriceAccumulate(200,$village->lumberLv),
                ),
            'wheat' => array(
                'wood' => $this->upgradePriceAccumulate(200,$village->wheatLv),
                'stone' => $this->upgradePriceAccumulate(200,$village->wheatLv),
                'soil' => $this->upgradePriceAccumulate(200,$village->wheatLv),
                'wheat' => $this->upgradePriceAccumulate(200,$village->wheatLv),
                ),
            'quarry' => array(
                'wood' => $this->upgradePriceAccumulate(200,$village->quarryLv),
                'stone' => $this->upgradePriceAccumulate(200,$village->quarryLv),
                'soil' => $this->upgradePriceAccumulate(200,$village->quarryLv),
                'wheat' => $this->upgradePriceAccumulate(200,$village->quarryLv),
                ),
            'soil' => array(
                'wood' => $this->upgradePriceAccumulate(200,$village->soilLv),
                'stone' => $this->upgradePriceAccumulate(200,$village->soilLv),
                'soil' => $this->upgradePriceAccumulate(200,$village->soilLv),
                'wheat' => $this->upgradePriceAccumulate(200,$village->soilLv),
                ),
            );
    }

    function upgradePriceAccumulate($basicPrice,$buildingLv){
        return ($buildingLv == 1)?$basicPrice:floor($basicPrice*(1.5**($buildingLv-1)));
    }

    function possibleLevelUp($upgradePrice,$village,$building){
        if(($village->Wood >= $upgradePrice[$building]['wood']) && ($village->Stone >= $upgradePrice[$building]['stone']) && ($village->Soil >= $upgradePrice[$building]['soil']) && ($village->Wheat >= $upgradePrice[$building]['wheat'])){
            return true;
        }else{
            return false;
        }
    }
}