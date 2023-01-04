<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerVisitFrequency extends Model
{
    use HasFactory;
    protected $connection = 'qb_sales';
    protected $table = 'qb_customer_visit_frequency';
    public $timestamps = false;
}
