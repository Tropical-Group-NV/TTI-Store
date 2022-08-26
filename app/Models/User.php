<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use LdapRecord\Models\Model;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $connection = 'qb_sales';
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'username',
        'password',
        'name',
        'last_name',
        'user_type_id',
        'active',
        'auth_key',
        'password_reset',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
//        'remember_token',
//        'two_factor_recovery_codes',
//        'two_factor_secret',
    ];

    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
//    protected $appends = [
//        'profile_photo_url',
//    ];

    public function getLdapGuidColumn()
    {
        return 'auth_key';
    }
    public function setLdapGuid($guid)
    {
        // TODO: Implement setLdapGuid() method.
    }

    public function setLdapDomain($domain)
    {
        // TODO: Implement setLdapDomain() method.
    }
}
