<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('settings')){
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->integer('field_id');
                $table->integer('year_checking');
                $table->integer('panel_checking');
                $table->integer('panel_measurement');
                $table->integer('month_period');
                $table->integer('year');
                $table->integer('start_month');
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
        Schema::dropIfExists('settings');
    }
}
