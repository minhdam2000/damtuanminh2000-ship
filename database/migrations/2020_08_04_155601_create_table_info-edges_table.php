<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInfoEdgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_edges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('edge_id')->unsigned();
            $table->float('ram');
            $table->float('cpu');
            $table->timestamps();
        });
        Schema::table('info_edges', function (Blueprint $table) {
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
        Schema::dropIfExists('info_edges');
    }
}
