<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $connection='qb_sales';
    protected $table= 'view_CustomFieldBranch';

    public $timestamps= false;
}
