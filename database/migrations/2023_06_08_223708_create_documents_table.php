<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        if(!Schema::hasTable('documents')){

            Schema::create('documents', function (Blueprint $table) {
                $table->id();
                $table->string('file_name', 100);
                $table->string('document_name', 100);
                $table->integer('field_id');
                $table->integer('document_id');
                $table->string('document_remarks', 10000);
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
        Schema::dropIfExists('documents');
    }
}
