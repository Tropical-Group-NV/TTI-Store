<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CartItem extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection='qb_sales';
    protected $table= 'temp_sales_cart';
    protected $primaryKey = 'id';

    protected $fillable =
        [
            'id',
            'prod_id',
            'qty',
            'uid'
        ];

    public $timestamps= false;
}
