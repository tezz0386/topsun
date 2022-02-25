<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('quotation')->nullable();
            $table->string('icon')->nullable();
            $table->string('logo')->nullable();
            $table->string('close_day')->nullable();
            $table->string('open_time')->nullable();
            $table->string('close_time')->nullable();
            $table->string('email');
            $table->string('contact_no');
            $table->string('address')->nullable();
            $table->longText('location')->nullable();
            $table->text('facebook_link')->nullable();
            $table->text('twitter_link')->nullable();
            $table->text('insta_link')->nullable();
            $table->text('youtube_link')->nullable();
            $table->text('linkedin_link')->nullable();
            $table->mediumText('google_link')->nullable();
            $table->bigInteger('whatsapp_no')->nullable();
            $table->bigInteger('viber_no')->nullable();
            $table->string('title_tag', 191)->nullable();
            $table->mediumText('meta_keywords')->nullable();
            $table->mediumText('meta_description')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
