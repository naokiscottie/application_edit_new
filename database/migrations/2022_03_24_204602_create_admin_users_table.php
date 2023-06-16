<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('admin_users')){
            Schema::create('admin_users', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('email')->unique();
                $table->string('password');
                $table->tinyInteger('locked_flg')->default(0);
                $table->integer('error_count')->unsigned()->default(0);
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
        Schema::dropIfExists('admin_users');
    }
}
