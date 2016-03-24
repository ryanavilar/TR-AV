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
        'archer', 'swordsman', 'horseman', 'archerLv','swordsmanLv','horsemanLv','user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'archer' => 'int',
        'swordsman' => 'int',
        'horseman' => 'int',
        'archerLv' => 'int',
        'swordsmanLv' => 'int',
        'horsemanLv' => 'int',
        'user_id'=>'int',
    ];

    /**
     * Get all of the tasks for the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
