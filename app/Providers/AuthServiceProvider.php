<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use LdapRecord\LdapRecordException;


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
        try
        {

            Fortify::authenticateUsing(
                function ($request)
                {
                    $getGUID = DB::connection('tgncloud')->table('users')->where('username', $request->username)->get()->first();
                    DB::connection('qb_sales')->table('users')->where('username', $request->username)->update(['auth_key' => $getGUID->guid]);
                    $validated = Auth::validate([
                    'samaccountname' => $request->username,
                    'password' => $request->password
                ]);

                return $validated ? Auth::getLastAttempted() : null;
            });
        }
        catch (LdapRecordException $exception)
        {

        }


    }
}
