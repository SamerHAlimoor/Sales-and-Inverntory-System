<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItemCategory extends Model
{
    use HasFactory;
    protected $table = "inventory_item_categories";

    protected $fillable = [
        'name', 'created_at', 'updated_at', 'added_by', 'updated_by', 'com_code', 'date', 'active'
    ];
}