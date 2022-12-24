<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers_with_orders_details', function (Blueprint $table) {
            /*
 'suppliers_with_orders_auto_serial', 'order_type', 'com_code', 'delivered_quantity',
        'uom_id', 'is_parent_uom', 'unit_price', 'total_price', 'order_date', 'added_by',
        'created_at', 'updated_by', 'updated_at', 'item_code', 'batch_auto_serial', 'production_date',
        'expire_date', 'item_card_type', 'approved_by'

            */
            $table->id();
            $table->bigInteger('suppliers_with_orders_auto_serial')->nullable();
            $table->bigInteger('com_code')->nullable();
            $table->bigInteger('uom_id')->nullable();
            $table->tinyInteger('is_parent_uom')->nullable(); // is 1-  main uom or 2-  retail
            $table->decimal('unit_price')->nullable();
            $table->decimal('total_price')->nullable();
            $table->decimal('delivered_quantity')->nullable();
            $table->date('order_date')->nullable();
            $table->bigInteger('added_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('item_code')->nullable();
            $table->bigInteger('batch_auto_serial')->nullable();
            $table->date('production_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->bigInteger('item_card_type')->nullable();
            $table->bigInteger('approved_by')->nullable();
            $table->tinyInteger('order_type')->nullable(); //[1-Purchases,2-return on same pill 3-return on general
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers_with_orders_details');
    }
};