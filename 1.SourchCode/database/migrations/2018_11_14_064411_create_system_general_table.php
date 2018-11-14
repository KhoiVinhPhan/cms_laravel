<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_general', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_logo')->nullable();
            $table->string('title_logo')->nullable();
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
        Schema::dropIfExists('system_general');
    }
}
