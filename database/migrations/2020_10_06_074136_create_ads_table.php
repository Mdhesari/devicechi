<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->foreginId('user_id')->index();
            $table->foreignId('city_id')->index();
            $table->foreignId('model_id')->index();
            $table->decimal('price', 12, 2);
            $table->unsignedTinyInteger('is_available')->default(1); /* 0: unavailable, 1: available, 2: pending */
            $table->string('location');
            $table->json('meta');
            /* contacts, meta_title, meta_description, age  */

            $table->boolean('is_multicard');
            $table->boolean('is_phone_hidden');
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
        Schema::dropIfExists('ads');
    }
}
