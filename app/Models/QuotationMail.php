<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationMail extends Model
{
    use HasFactory;

    protected $connection = 'qb_sales';
    protected $table = 'quotation_email_send';
    public $timestamps = false;
}
