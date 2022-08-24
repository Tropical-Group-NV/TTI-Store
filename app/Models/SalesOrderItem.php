<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
    public $timestamps= false;

    use HasFactory;
    protected $connection='qb_sales';
    protected $table= 'sales_order_items';
}
