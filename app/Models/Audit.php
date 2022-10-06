<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    protected $connection= 'sqlsrv';
    protected $table='audits';
    protected $primaryKey='id';
}
