<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *l
     * @return void
     */
    public function up()
    {
        Schema::create('key_streams', function (Blueprint $table) {
            //
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('cam_id')->unsigned();
            $table->string('key_value');
            $table->timestamp('timestamp');
        });

        Schema::table('key_streams', function (Blueprint $table) {
            $table->foreign('cam_id')->references('id')->on('cameras')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('key_streams', function (Blueprint $table) {
            //
        });
    }
}
