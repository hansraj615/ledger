<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgerEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subcompany_id');
            $table->foreign('subcompany_id')->references('id')->on('sub_companies');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('price');
            $table->bigInteger('quantity');
            $table->bigInteger('transation_id');
            $table->integer('payment_type');
            $table->integer('card_type');
            $table->integer('bank');
            $table->integer('otherbank');
            $table->integer('amount_type');
            $table->integer('account');
            $table->string('checknumber');
            $table->string('ddnumber');
            $table->bigInteger('amount');
            $table->bigInteger('finalamount');
            $table->bigInteger('amounthealth');
            $table->string('description');

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
        Schema::dropIfExists('ledger_entries');
    }
}
