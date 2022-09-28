<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportSoInProcess extends Model
{
    use HasFactory;
    protected $connection = 'picklist';
    protected $table = 'import_so_in_process';
    public $timestamps = false;
}
