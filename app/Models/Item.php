<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Item extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection='qb_sales';
    protected $table= 'view_item';
    public $primaryKey = 'ListID';
    public $incrementing = false;

    public $timestamps= false;

}
