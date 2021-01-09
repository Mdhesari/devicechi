<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdUserSeenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_user_seen', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignUuid('ad_id');

            $table->unsignedBigInteger('count')->default(0);

            $table->primary(['ad_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_user_seen');
    }
}
