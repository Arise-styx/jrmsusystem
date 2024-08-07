<?php

namespace App\Ldap\Scopes;

use LdapRecord\Models\Model;
use LdapRecord\Models\Scope;
use LdapRecord\Query\Model\Builder;

class OnlyWebUser implements Scope
{
    /**
     * Apply the scope to the given query.
     */

    // public function apply(Builder $query, Model $model): void
    public function apply(Builder $query, Model $model): void
    {
        $query->in('cn=Users,ou=WebUsers,dc=moelci1,dc=coop');
    }
}
