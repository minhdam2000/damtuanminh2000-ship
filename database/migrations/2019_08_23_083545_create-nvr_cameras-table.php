<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNvrCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nvr_cameras', function (Blueprint $table) {
            //
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('nvr_id')->unsigned();
            $table->bigInteger('cam_id')->unsigned();
            $table->string('profile')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('recoding')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('record_mode');
            $table->string('record_meta')->nullable();
        });

        Schema::table('nvr_cameras', function (Blueprint $table) {
            $table->foreign('nvr_id')->references('id')->on('nvrs')->onDelete('cascade');
            $table->foreign('cam_id')->references('id')->on('cameras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nvr_cameras', function (Blueprint $table) {
            //
        });
    }
}
