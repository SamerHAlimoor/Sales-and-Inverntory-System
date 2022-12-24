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
        Schema::create('suppliers_with_orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('order_type')->nullable(); //[1-Purchases,2-return on same pill 3-return on general
            $table->bigInteger('auto_serial')->nullable();
            $table->bigInteger('DOC_NO')->nullable();
            $table->date('order_date')->nullable();
            $table->bigInteger('supplier_code')->nullable();
            $table->tinyInteger('is_approved')->nullable();
            $table->tinyInteger('discount_type')->nullable(); //[1-percent 2-value]
            $table->decimal('discount_percent')->nullable();
            $table->decimal('discount_value')->default(0);
            $table->decimal('tax_percent')->default(0);
            $table->decimal('tax_value')->default(0);
            $table->decimal('total_before_discount')->default(0);
            $table->decimal('total_cost')->default(0);
            $table->bigInteger('account_number')->nullable();
            $table->decimal('money_for_account')->nullable();
            $table->tinyInteger('pill_type')->nullable();
            $table->decimal('what_paid')->default(0);
            $table->decimal('what_remain')->default(0);
            $table->bigInteger('treasuries_transactions_id')->nullable();
            $table->decimal('supplier_balance_before')->nullable();
            $table->decimal('supplier_balance_after')->nullable();
            $table->decimal('total_cost_items')->nullable();
            $table->bigInteger('store_id')->nullable();
            $table->bigInteger('com_code')->nullable();
            $table->string('notes')->nullable();
            $table->bigInteger('added_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('suppliers_with_orders');
    }
};