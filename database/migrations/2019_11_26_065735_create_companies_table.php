<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_code');
            $table->string('name');
            $table->biginteger('phone_no');
            $table->biginteger('mobile_no');
            $table->string('email');
            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->integer('pincode');
            $table->text('address');
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
        Schema::dropIfExists('companies');
    }
}
