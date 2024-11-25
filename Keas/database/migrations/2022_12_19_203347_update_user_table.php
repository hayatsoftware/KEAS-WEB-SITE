<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 500)->after('name');
            $table->string('last_name', 500)->after('first_name');
            $table->string('code', 5)->nullable()->after('last_name');
            $table->string('ip', 500)->after('phone');
            $table->string('user_agent', 1000)->after('ip');
            $table->smallInteger('is_kvkk')->default(0)->after('ip');
            $table->smallInteger('is_sms')->default(0)->after('is_kvkk');
            $table->smallInteger('is_email')->default(0)->after('is_sms');
            $table->smallInteger('is_crm')->default(0)->after('data');
            $table->string('crm_id', 255)->nullable()->after('is_crm');
            $table->json('request')->nullable()->after('crm_id');
            $table->json('response')->nullable()->after('request');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
