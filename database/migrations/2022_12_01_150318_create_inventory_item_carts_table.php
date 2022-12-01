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
        Schema::create('inventory_item_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_type')->nullable();
            $table->string('name');
            $table->integer('inv_item_card_categories_id')->nullable();
            $table->integer('parent_inv_item_card_id')->nullable();
            $table->boolean('does_has_retail_unit')->nullable();
            $table->integer('retail_uom')->nullable();
            $table->integer('uom_id')->nullable();
            $table->integer('retail_uom_qty_to_parent')->nullable();
            $table->integer('item_code')->nullable();
            $table->string('barcode')->nullable();
            $table->double('price')->nullable();
            $table->double('nos_bulk_price')->nullable();
            $table->double('bulk_price')->nullable();
            $table->double('price_retail')->nullable();
            $table->double('nos_bulk_price_retail')->nullable();  //bulk => بالجملة
            $table->double('bulk_price_retail')->nullable();
            $table->double('cost_price')->nullable();
            $table->double('cost_price_retail')->nullable();
            $table->boolean('has_fixed_price')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('qty_retail')->nullable();
            $table->integer('qty_all_retails')->nullable();
            $table->integer('all_qty')->nullable();
            $table->integer('retail_uom_id')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('active')->default(0); // 0=>active
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('com_code');
            $table->date('date');
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
        Schema::dropIfExists('inventory_item_carts');
    }
};