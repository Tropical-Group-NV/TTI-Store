<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $connection='qb_sales';
    protected $table= 'temp_sales_cart';

    protected $fillable =
        [
            'id',
            'prod_id',
            'qty',
            'uid'
        ];

    public $timestamps= false;
}
