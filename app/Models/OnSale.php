<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnSale extends Model
{
    use HasFactory;

    use HasFactory;
    protected $connection='qb_sales';
    protected $table= 'item_onsale';
    protected $primaryKey = 'ListID';
    public $incrementing = false;

    public $timestamps= false;
}
