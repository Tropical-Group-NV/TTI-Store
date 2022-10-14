<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
    use HasFactory;
    protected $connection = 'qb_sales';
    protected $table = 'users_customer';
    public $timestamps = false;
}
