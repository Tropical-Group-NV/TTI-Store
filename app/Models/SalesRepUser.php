<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRepUser extends Model
{
    use HasFactory;

    protected $connection = 'qb_sales';
    protected $table = 'users_salesRep';
}
