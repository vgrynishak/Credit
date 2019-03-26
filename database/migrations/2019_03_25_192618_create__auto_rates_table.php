<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Auto_rates', function (Blueprint $table) {
            $table->integer('credit');
            $table->foreign('credit')->references('id')->on('autos');
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
        Schema::dropIfExists('Auto_rates');
    }
}
