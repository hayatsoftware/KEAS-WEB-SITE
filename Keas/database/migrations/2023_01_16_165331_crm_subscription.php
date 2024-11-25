<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrmSubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('country_group_id')->nullable();
            $table->smallInteger('language_id')->nullable();
            $table->string('email', 1000);
            $table->string('ip', 50);
            $table->string('user_agent', 500);
            $table->json('products')->nullable();
            $table->smallInteger('status')->default(0);
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
        Schema::dropIfExists('crm_subscriptions');
    }
}
