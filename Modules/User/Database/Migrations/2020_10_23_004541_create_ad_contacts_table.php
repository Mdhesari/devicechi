<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_contacts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ad_id');
            $table->foreignId('contact_type_id');
            $table->string('value');
            $table->timestamp('value_verified_at')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();

            $table->unique(['ad_id', 'value']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_contacts');
    }
}
