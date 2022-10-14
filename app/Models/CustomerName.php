<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerName extends Model
{
    use HasFactory;
    protected $connection = 'qb_sales';
    protected $table = 'view_customer_list';
    public $timestamps = false;
}
