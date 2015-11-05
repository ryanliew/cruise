<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class CabinPolicy
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
}
