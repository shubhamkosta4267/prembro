<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInstallment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'installment_date',
        'payment',
        'screenshot',
        'remark',
        'status',
    ]; 
}
