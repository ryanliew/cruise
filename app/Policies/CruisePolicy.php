<?php

namespace App\Policies;
use App\User;
use App\Cruise;
use Illuminate\Auth\Access\HandlesAuthorization;

class CruisePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Cruise $cruise)
    {
        return true;
    }
}
