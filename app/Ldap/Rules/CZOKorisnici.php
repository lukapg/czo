<?php

namespace App\Ldap\Rules;

use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\ActiveDirectory\Group;

class CZOKorisnici extends Rule
{
    /**
     * Check if the rule passes validation.
     *
     * @return bool
     */
    public function isValid()
    {
	    $korisnici = Group::find('cn=CZO_Svi,dc=cedis,dc=local');
	    return $this->user->groups()->recursive()->exists($korisnici);
    }
}
