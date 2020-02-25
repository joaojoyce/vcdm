<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVcdmTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('vcdm.store_table_name'), function (Blueprint $table) {
            $table->increments('id');
            $table->text('event');
            $table->timestamps();
        });
        Schema::create(config('vcdm.checkpoint_table_name'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedInteger('event_id');
            $table->text('domain_model');
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
        Schema::dropIfExists(config('vcdm.store_table_name'));
        Schema::dropIfExists(config('vcdm.checkpoint_table_name'));
    }
}
