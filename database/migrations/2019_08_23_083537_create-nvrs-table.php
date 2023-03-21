<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNvrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nvrs', function (Blueprint $table) {
            //
            $table->bigIncrements('id')->unsigned();
            $table->string('master_key');
            $table->string('password')->nullable();
            $table->string('ip')->nullable();
            $table->string('ip_public')->nullable();
            $table->smallInteger('access_port')->nullable()->unsigned();
            $table->string('mac_address')->nullable();
            $table->string('nvr_name')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->longText('description')->nullable();
            $table->longText('model')->nullable();
            $table->tinyInteger('active')->nullable();
            $table->bigInteger('rtsp_port')->nullable();
            $table->text('config')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nvrs', function (Blueprint $table) {
            //
        });
    }
}
