<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sub_companies', function (Blueprint $table) {
            $table->biginteger('user_id')->unsigned();
            $table->biginteger('sub_company_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_company_id')->references('id')->on('sub_companies')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'sub_company_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_sub_companies');
    }
}
