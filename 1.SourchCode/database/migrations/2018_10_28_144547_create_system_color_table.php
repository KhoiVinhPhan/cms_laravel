<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_color', function (Blueprint $table) {
            $table->increments('color_id');
            $table->string('color_menu_top');
            $table->string('color_logo');
            $table->string('color_active_dark');
            $table->string('sidebar');
            $table->integer('user_id');
            $table->integer('user_id_maked')->nullable();
            $table->integer('user_id_deleted')->nullable();
            $table->integer('user_id_updated')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('system_color');
    }
}
