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
            $table->integer('subcompany_id');
            $table->foreign('subcompany_id')->references('id')->on('sub_companies');
            $table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('amount_type');
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
