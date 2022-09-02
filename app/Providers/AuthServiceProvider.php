<?php

namespace App\Providers;

use App\Models\User;
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

            /** To Do: Customer Authentication  */

            Fortify::authenticateUsing(
                function ($request)
                {
                    $findUser = User::query()->where('username', $request->username)->exists();
                    if ($findUser)
                    {
                        $user = User::query()->where('username', $request->username)->first();
                        $findCustomer = DB::connection('qb_sales')->table('users_customer')->where('user_id', $user->id)->exists();
                        if ($findCustomer)
                        {
                            Auth::guard('eloquent');
                            $validated = Auth::guard('eloquent')->attempt([
                                'username' => $request->username,
                                'password' => $request->password
                            ]);
                        }
                        else
                        {
                            $getGUID = DB::connection('tgncloud')->table('users')->where('username', $request->username)->get()->first();
                            DB::connection('qb_sales')->table('users')->where('username', $request->username)->update(['auth_key' => $getGUID->guid]);
                            $validated = Auth::guard('web')->validate([
                                'sAMAccountname' => $request->username,
                                'password' => $request->password
                            ]);
//                            if ($validated)
//                            {
//                                die('Result1');
//                            }
//                            else
//                            {
//                                die('result2');
//                            }
                        }
                    }
                    else
                    {
                        $validated = Auth::guard('eloquent')->validate([
                            'username' => $request->username,
                            'password' => $request->password
                        ]);
                    }
                return $validated ? Auth::getLastAttempted() : null;
            });
        }
        catch (LdapRecordException $exception)
        {

        }


    }
}
