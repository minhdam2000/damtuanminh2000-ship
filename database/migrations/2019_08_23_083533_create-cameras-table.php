<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('ip')->nullable();
            $table->bigInteger('edge_id')->unsigned();
            $table->string('cam_name')->nullable();
            $table->string('cam_pass')->nullable();
            $table->string('login_pass');
            $table->string('path')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('firmware_version')->nullable();
            $table->string('location')->nullable();
            $table->text('rtsp_link')->nullable();
            $table->tinyInteger('cam_status')->nullable();
            $table->timestamp('last_create')->nullable();
            $table->tinyInteger('cam_delete')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('cameras', function (Blueprint $table) {
            $table->foreign('edge_id')->references('id')->on('edges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cameras', function (Blueprint $table) {
            //
        });
    }
}
