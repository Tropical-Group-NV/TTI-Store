<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;

    protected $connection = 'qb_sales';
    protected $table = 'quotation_items';
    public $timestamps = false;
}
