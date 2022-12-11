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
        Schema::create('customers', function (Blueprint $table) {
            /*
   
        'name','account_number',
        'start_balance','current_balance','notes','customer_code','phones','address'
        ,'created_at','updated_at','added_by','updated_by','com_code','date','active','start_balance_status'
       
            */
            $table->id();
            $table->string('name');
            $table->bigInteger('account_number')->nullable();
            $table->decimal('start_balance')->nullable();
            $table->decimal('current_balance')->nullable();
            $table->string('notes')->nullable()->nullable();
            $table->bigInteger('customer_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('date')->nullable();
            $table->date('last_update')->nullable();
            $table->tinyInteger('active')->nullable();
            $table->tinyInteger('start_balance_status')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('com_code')->nullable();
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
        Schema::dropIfExists('customers');
    }
};