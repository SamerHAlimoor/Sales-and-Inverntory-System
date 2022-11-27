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
        Schema::create('treasuries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('is_master')->default(0);  // is Treasury is main or branch
            $table->bigInteger('last_receipt_exchange'); // the last Receipt رقم اخر وصل للصرف
            $table->bigInteger('last_receipt_collect'); // the last Receipt رقم اخر وصل للقبض
            $table->string('address');
            $table->boolean('active')->default(0); // 0=>active
            $table->string('phone');
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
        Schema::dropIfExists('treasuries');
    }
};