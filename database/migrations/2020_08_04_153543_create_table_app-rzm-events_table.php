<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAppRzmEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_rzm_events', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->text('event_type')->nullable();
            $table->text('content')->nullable();
            $table->timestamp('occurr_time')->nullable();
            $table->bigInteger('application_id')->unsigned();
            $table->bigInteger('flag')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::table('app_rzm_events', function (Blueprint $table) {
            $table->foreign('cam_id')->references('id')->on('cameras')->onDelete('cascade');
            $table->foreign('application_id')->references('id')->on('applications')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_rzm_events');
    }
}
