<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin',function($user){
            return $user->role_id == 1 ;
        });

        Gate::define('is-user',function($user){
            return in_array($user->role_id, [1,2]);
        });

        Gate::define('is-focal-point',function($user, $id){
            if(\Auth::user()->role_id ==1 ){
                return true;
            }else{
                foreach($user->members as $member){
                    if($id == $member->id){
                        return true;
                        break;
                    }
                }
                return false;
            }

        });
    }
}
