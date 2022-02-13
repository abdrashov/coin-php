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
        Schema::create('expense_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('income_category_id')->constrained('income_categories');
            $table->foreignId('expense_category_id')->constrained('expense_categories');
            $table->bigInteger('cash');
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
        Schema::dropIfExists('expense_transactions');
    }
};
