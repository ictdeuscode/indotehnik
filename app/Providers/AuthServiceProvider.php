<?php

namespace App\Providers;

use App\Models\MasterPegawai;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if(!empty($user->role))
            {
                return $user->role->id == 1 ? true : null;
            }
            else
            {
                return null;
            }
        });

        Gate::define('hasPermission', function (MasterPegawai $user, $permission) {
            if(!empty($user->role))
            {
                $permissions = $user->role->permissions->pluck('nama')->toArray();
                return in_array($permission, $permissions);
            }
            else
            {
                return false;
            }
        });
    }
}
