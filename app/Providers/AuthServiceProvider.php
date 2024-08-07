<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// Import OU Authentication Scope
// use App\Ldap\Scopes\OnlyWebUser;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */

    // public function boot(): void
    public function boot(): void
    {
        //

        $this->registerPolicies();

        // \LdapRecord\Models\ActiveDirectory\User::addGlobalScope(
        //     new OnlyWebUser
        // );
    }
}
