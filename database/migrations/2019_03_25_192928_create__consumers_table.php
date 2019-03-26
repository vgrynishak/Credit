<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumers', function (Blueprint $table) {
            $table->Integer('id')->unique();
            $table->string('uri')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('form_id')->nullable();
            $table->double('commission')->nullable();
            $table->integer('payment')->nullable();
            $table->integer('sumFrom')->nullable();
            $table->integer('sumTo')->nullable();
            $table->string('earlyRepayment')->nullable();
            $table->double('monthly_comission')->nullable();
            $table->string('remote_offer_link')->nullable();
            $table->string('age')->nullable();
            $table->text('reference')->nullable();
            $table->string('usd')->nullable();
            $table->string('eur')->nullable();
            $table->string('uah')->nullable();
            $table->integer('bank')->nullable();
            $table->double('month_payment')->nullable();
            $table->double('overpay')->nullable();
            $table->double('overpay_rate')->nullable();
            $table->string('badge_id')->nullable();
            $table->string('badge_color')->nullable();
            $table->string('badge_title')->nullable();
            $table->integer('is_promo')->nullable();
            $table->string('ratingValue')->nullable();
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumers');
    }
}
