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
        Schema::create('admin_pannel_settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->string('general_alert')->nullable();
            $table->string('address');
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('com_code');
            $table->integer('customer_parent_account_number')->nullable();
            $table->integer('suppliers_parent_account_number')->nullable();
            $table->integer('delegate_parent_account_number')->nullable();
            $table->integer('employees_parent_account_number')->nullable();
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
        Schema::dropIfExists('admin_pannel_settings');
    }
};