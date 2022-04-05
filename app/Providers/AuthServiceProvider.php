<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Discussion;
use Illuminate\Auth\Access\Response;
use Auth;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('update-discussion', function (User $user, Discussion $discussion) {
            return $user->id === $discussion->user_id ? Response::allow()
            : Response::deny('You must be an administrator.');
        });


      // permition to make replay as best replay for the manager 
        Gate::define('best-reply', function (Discussion $discussion) {

           return Auth::id() ==  $discussion->user_id;
        });


        Gate::define('remove-permission',function(User $user){ return $user->is_admin; });
    }


}
