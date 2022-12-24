<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItemCart extends Model
{
    use HasFactory;
    // protected $table = "inventory_item_carts";

    protected $fillable = [
        'item_type', 'name', 'inv_item_card_categories_id', 'parent_inv_item_card_id',
        'does_has_retail_unit', 'retail_uom', 'uom_id', 'retail_uom_qty_to_parent',
        'created_at', 'updated_at', 'added_by', 'updated_by', 'com_code', 'active',
        'date', 'item_code', 'barcode', 'price', 'nos_bulk_price', 'bulk_price',
        'price_retail', 'nos_bulk_price_retail', 'bulk_price_retail',
        'cost_price', 'cost_price_retail', 'has_fixed_price', 'qty',
        'qty_Retail', 'qty_all_retails', 'photo', 'retail_uom_id',
        'all_qty'
    ];
}