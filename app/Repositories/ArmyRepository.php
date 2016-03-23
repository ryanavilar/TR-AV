<?php

namespace App\Repositories;

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
        return Village::where('user_id', $user->id)->get();
    }
}