<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    // protected $table = "suupliers";
    protected $fillable = [
        'name', 'account_number',
        'start_balance', 'current_balance', 'notes', 'supplier_code',
        'phones', 'address', 'suppliers_categories_id', 'created_at', 'updated_at',
        'added_by', 'updated_by', 'com_code', 'date', 'active', 'start_balance_status'
    ];
}