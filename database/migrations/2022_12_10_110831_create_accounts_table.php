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
        Schema::create('accounts', function (Blueprint $table) {
            /*

'name', 'account_type', 'parent_account_number', 'account_number',
        'start_balance', 'current_balance', 'other_table_fk', 'notes',
        'created_at', 'updated_at', 'added_by', 'updated_by', 'com_code',
        'date', 'active', 'is_parent', 'start_balance_status'
            */
            $table->id();
            $table->string('name');
            $table->tinyInteger('account_type');
            $table->bigInteger('parent_account_number')->nullable();
            $table->bigInteger('account_number')->nullable();
            $table->decimal('start_balance')->nullable();
            $table->decimal('current_balance')->nullable();
            $table->bigInteger('other_table_fk')->nullable(); // الشجرة المحاسبية
            $table->string('notes')->nullable();
            $table->boolean('is_parent')->nullable();
            $table->date('date')->nullable();
            $table->date('last_update')->nullable();
            $table->tinyInteger('active');
            $table->tinyInteger('start_balance_status')->nullable();
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
        Schema::dropIfExists('accounts');
    }
};