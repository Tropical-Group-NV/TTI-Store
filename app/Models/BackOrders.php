<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackOrders extends Model
{
    use HasFactory;
    protected $connection='qb_sales';
    protected $table= 'back_sales_order_notification';

    public $timestamps= false;
}
