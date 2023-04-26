<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
    public function boot(): void
    {
        Gate::define('access-admin', function(User $user){
            $admins_id = DB::table('model_has_roles')->select('model_id')->where('role_id', 3)->pluck('model_id')->toArray();
            if (in_array($user->id, $admins_id)){
                return true;
            }else{
                return false;
            }
        });

        Gate::define('access-manager', function(User $user){
            $managers_id = DB::table('model_has_roles')->select('model_id')->where('role_id', 2)->pluck('model_id')->toArray();
            if (in_array($user->id, $managers_id)){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('access-teacher', function(User $user){
            $teachers_id = DB::table('model_has_roles')->select('model_id')->where('role_id', 1)->pluck('model_id')->toArray();
            if (in_array($user->id, $teachers_id)){
                return true;
            }else{
                return false;
            }
        });
    }
}
