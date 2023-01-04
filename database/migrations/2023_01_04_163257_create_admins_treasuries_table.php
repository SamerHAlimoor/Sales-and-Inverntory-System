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
        Schema::create('admins_treasuries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('com_code')->nullable();
            $table->bigInteger('admin_id')->nullable();
            $table->bigInteger('treasuries_id')->nullable();
            $table->date('date')->nullable();
            $table->tinyInteger('active');
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
        Schema::dropIfExists('admins_treasuries');
    }
};