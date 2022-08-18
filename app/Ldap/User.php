<?php

namespace App\Ldap;

use LdapRecord\Models\Model;

class User extends Model
{
    /**
     * The object classes of the LDAP model.
     *
     * @var array
     *
     */
    protected $connection = 'qb_sales';
    protected $table = 'afdelingen';

    public static $objectClasses = [];

    public function getLdapGuidColumn()
    {
        return 'auth_key';
    }
}
