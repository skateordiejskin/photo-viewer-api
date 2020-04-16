<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhotosMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('storage_path');
            $table->string('storage_location'); //local, s3, gcp, etc.
            $table->string('url');
            $table->integer('external_id');
            $table->json('dimensions');
            $table->json('metadata');
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

         Schema::dropIfExists('photos');
    }
}
