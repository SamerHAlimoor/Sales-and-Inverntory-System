<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliersWithOrdersDetails extends Model
{

    use HasFactory;
    // protected $table="suppliers_with_orders_details";
    protected $fillable = [
        'suppliers_with_orders_auto_serial', 'order_type', 'com_code', 'delivered_quantity',
        'uom_id', 'is_parent_uom', 'unit_price', 'total_price', 'order_date', 'added_by',
        'created_at', 'updated_by', 'updated_at', 'item_code', 'batch_auto_serial', 'production_date',
        'expire_date', 'item_card_type', 'approved_by'
    ];
}