<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Dusterio\LumenPassport\LumenPassport;

/**
 * Class AuthServiceProvider
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Scopes for the handling permissions
         */
        Passport::tokensCan([
            'open-tunnel' => 'Open 1st door (tunnel)',
            'open-office' => 'Open 2nd door (office)',
        ]);

        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });

        /**
         * Registration of Passport routes
         */
        LumenPassport::routes($this->app->router);
    }
}
