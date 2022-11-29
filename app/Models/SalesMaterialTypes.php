<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesMaterialTypes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'created_at', 'updated_at', 'added_by', 'updated_by', 'com_code', 'date', 'active'
    ];
}