<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDescription extends Model
{
    use HasFactory;
    protected $connection = 'qb_sales';
    protected $table = 'item_description';
}
