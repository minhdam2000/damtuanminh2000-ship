<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoNvrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_nvrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nvr_id')->unsigned();
            $table->float('ram');
            $table->float('cpu');
            $table->timestamps();
        });

        Schema::table('info_nvrs', function (Blueprint $table) {
            $table->foreign('nvr_id')->references('id')->on('nvrs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_nvrs');
    }
}
