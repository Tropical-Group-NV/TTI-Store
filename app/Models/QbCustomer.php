<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbCustomer extends Model
{
    use HasFactory;
    use HasFactory;
    protected $connection='qb_sales';
    protected $table= 'view_qb_customer';
    protected $primaryKey = 'ListID';
    public $incrementing = false;
}
