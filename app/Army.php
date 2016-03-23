<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Army extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'archer', 'swordsman', 'horseman', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'barrackLv' => 'int',
        'warehouseLv' => 'int',
        'hallLv' => 'int',
        'Wood' => 'int',
        'Soil' => 'int',
        'Stone' => 'int',
        'Wheat' => 'int',
    ];

    /**
     * Get all of the tasks for the user.
     */
    public function village()
    {
        return $this->belongsTo(Village::class);
    }


}
