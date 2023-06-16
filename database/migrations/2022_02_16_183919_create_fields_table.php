<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable('fields')){

            Schema::create('fields', function (Blueprint $table) {

                $table->id();
                $table->string('field_name');
                $table->string('field_address');
                $table->float('power', 8, 3);
                $table->float('solar_power', 8 ,3);
                $table->dateTime('contract_date');
                $table->integer('contract_money');
                $table->integer('customer_id');
                $table->timestamps();

            });

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
}
