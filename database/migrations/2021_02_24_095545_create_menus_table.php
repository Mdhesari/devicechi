<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('key')->unique();

            $table->timestamps();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            $table->string('text')->nullable();
            $table->string('header')->nullable();
            $table->string('permission')->nullable();
            $table->string('class')->nullable();
            $table->string('route')->nullable();
            $table->json('route_params')->nullable();
            $table->string('url')->nullable();
            $table->string('target', 8)->default('_self');
            $table->string('icon_color')->nullable();
            $table->integer('sort')->default(0);
            $table->string('icon')->nullable();

            $table->foreignId('parent_id')->nullable();
            $table->foreignId('menu_id')->constrained();

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
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_items');
    }
}
