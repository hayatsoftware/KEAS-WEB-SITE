<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalePointsExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_points_extras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_points_id')->unsigned();
            $table->string('key', 100);
            $table->text('value');
            $table->timestamps();
            $table->foreign('sale_points_id')->references('id')->on('sale_points')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_points_extras');
    }
}
