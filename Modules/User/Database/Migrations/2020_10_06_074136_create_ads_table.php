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
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('city_id')->nullable();
            $table->foreignId('model_id')->nullable();
            $table->foreignId('model_variant_id')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->tinyInteger('age')->nullable(); // based on months
            $table->unsignedTinyInteger('status')->default(3); /* 0: unavailable, 1: available, 2: pending, 3: uncompleted */
            $table->text('location')->nullable();
            $table->json('meta_ad')->nullable();
            /* contacts, meta_title, meta_description, age  */

            $table->boolean('is_multicard')->nullable();
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
