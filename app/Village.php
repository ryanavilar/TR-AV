<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'villageName', 'barrackLv', 'warehouseLv', 'hallLv','lumberLv','wheatLv','quarryLv','soilLv', 'Wood', 'Stone', 'Soil', 'Wheat','user_id','location',
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
        'user_id'=>'int',
        'location'=>'int',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
