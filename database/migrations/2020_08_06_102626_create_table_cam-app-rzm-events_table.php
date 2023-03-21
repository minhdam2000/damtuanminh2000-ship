<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCamAppRzmEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cam_rzm_events', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('app_rzm_event_id')->unsigned();
            $table->bigInteger('cam_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('cam_rzm_events', function (Blueprint $table) {
            $table->foreign('app_rzm_event_id')->references('id')->on('app_rzm_events')->onDelete('cascade');
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
        Schema::dropIfExists('cam_rzm_events');
    }
}
