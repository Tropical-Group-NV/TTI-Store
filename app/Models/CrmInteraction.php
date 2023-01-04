<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmInteraction extends Model
{
    use HasFactory;
    protected $connection = 'qb_sales';
    protected $table = 'crm_interactions';
    public $timestamps = false;
}
