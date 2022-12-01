<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $connection='epas';
    protected $table= 'QB_Customer';

    protected $primaryKey = 'ListID';

    public function findById($id)
    {
        return Customer::query()->where('ListID', $id)->first();
    }
}
