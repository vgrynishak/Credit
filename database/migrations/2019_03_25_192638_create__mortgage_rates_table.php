<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMortgageRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Mortgage_rates', function (Blueprint $table) {
            $table->integer('credit');
            $table->foreign('credit')->references('id')->on('mortgages');
            $table->double('usd')->nullable();
            $table->double('uah')->nullable();
            $table->double('eur')->nullable();
            $table->integer('period');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Mortgage_rates');
    }
}
