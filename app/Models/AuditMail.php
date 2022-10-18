<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditMail extends Model
{
    use HasFactory;
    protected $table = 'audit_mail';
}
