<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCameraPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camera_permissions', function (Blueprint $table) {
            //
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('cam_id')->unsigned();
            $table->bigInteger('edge_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('camera_permissions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete ('cascade');
            $table->foreign('cam_id')->references('id')->on('cameras')->onDelete('cascade');
            $table->foreign('edge_id')->references('id')->on('edges')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camera_permission', function (Blueprint $table) {
            //
        });
    }
}
