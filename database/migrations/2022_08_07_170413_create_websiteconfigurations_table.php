<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websiteconfigurations', function (Blueprint $table) {
            $table->id();
            $table->string('instagram');
            $table->string('twitter');
            $table->string('facebook');
            $table->string('email');
            $table->string('header_hero');
            $table->string('announcement_title');
            $table->string('announcement_link');
            $table->string('generation_slug');
            $table->string('hero_image')->nullable();
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
        Schema::dropIfExists('websiteconfigurations');
    }
};
