<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('native_name');
            $table->string('localized_name');
            $table->string('phone', 50)->nullable();
            $table->string('email', 500)->nullable();
            $table->string('website', 500)->nullable();
            $table->string('native_city')->nullable();
            $table->string('localized_city')->nullable();
            $table->string('city_slug')->nullable();
            $table->string('native_address')->nullable();
            $table->string('localized_address')->nullable();
            $table->string('cords')->nullable();
            $table->smallInteger('status')->default(1);
            $table->smallInteger('zone_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_points');
    }
}
