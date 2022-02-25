<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('about_description');
            $table->string('our_mission')->nullable();
            $table->text('our_mission_summary')->nullable();
            $table->string('our_vision')->nullable();
            $table->text('our_vision_summary')->nullable();
            $table->string('our_objectives')->nullable();
            $table->text('our_objectives_summary')->nullable();
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
        Schema::dropIfExists('abouts');
    }
}
