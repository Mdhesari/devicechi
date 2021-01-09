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
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('user_id')->constrained();

            $table->foreignId('state_id')->nullable();
            $table->foreignId('phone_model_id')->nullable();
            $table->foreignId('phone_model_variant_id')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->tinyInteger('phone_age_id')->nullable(); // based on months
            $table->unsignedTinyInteger('status')->default(3); /* 0: unavailable, 1: available, 2: pending, 3: uncompleted */
            $table->text('location')->nullable();
            $table->json('meta_ad')->nullable();
            /* contacts, meta_title, meta_description, age  */

            $table->boolean('is_multicard')->default(0);
            $table->boolean('is_exchangeable')->default(0);
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
