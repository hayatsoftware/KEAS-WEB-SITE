<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 100);
            $table->smallInteger('status')->default(1);
            $table->smallInteger('country_group_id')->nullable();
            $table->smallInteger('language_id')->nullable();
            $table->string('ip', 50);
            $table->string('user_agent', 500);
            $table->json('request')->nullable();
            $table->json('response')->nullable();
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
        Schema::dropIfExists('crm_info');
    }
}
