<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_language', function (Blueprint $table) {
            $table->increments('language_id');
            $table->string('language');
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
        Schema::dropIfExists('system_language');
    }
}
