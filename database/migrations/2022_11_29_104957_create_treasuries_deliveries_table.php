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
        Schema::create('treasuries_deliveries', function (Blueprint $table) {
            $table->id();
            // 'treasuries_id','treasuries_can_delivery_id',
            $table->foreignId('treasuries_id')->constrained('treasuries')->cascadeOnDelete(); // الخزنة التي سوف تستلم 
            $table->foreignId('treasuries_can_delivery_id')->constrained('treasuries')->cascadeOnDelete(); // الخزنة التي سوف يتم تسليمها
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('com_code');
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
        Schema::dropIfExists('treasuries_deliveries');
    }
};