<?php

namespace App\Observers;

use App\Models\User;
use LdapRecord\Models\ActiveDirectory\Group;

class UserObserver
{

    public function creating(User $user) {
	    if (str_contains($user->sluzba, 'razvoj organizacije') || str_contains($user->sluzba, 'radne odnose i administraciju')) {
	    	$user->rola_id = 3;
	    }
	    elseif (str_contains($user->sluzba, 'kompetencija')) {
	    	$user->rola_id = 1;
	    }
	    else {
		$user->rola_id = 2;
	    }
    }
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {

    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
