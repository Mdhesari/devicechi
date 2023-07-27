<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedDecimal('price', 12);
            $table->string('currency', 8)->default('IRR');
            $table->unsignedSmallInteger('activate_after')->nullable();
            $table->string('activate_after_type', 8)->default('minute');
            $table->boolean('one_time')->default(true);
            $table->foreignId('admin_id')->nullable();
            $table->unsignedTinyInteger('order')->nullable();
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
        Schema::dropIfExists('promotions');
    }
}
