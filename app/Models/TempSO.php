<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSO extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    protected $table = 'temp_so';
}
