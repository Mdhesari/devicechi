<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //TODO: which admin user has chaged the account!
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('amount', 12);

            $table->string('title')->nullable();
            $table->string('description')->nullable();

            $table->tinyInteger('status')->default(2); // pending is default
            $table->foreignId('user_id')->constrained();

            $table->foreignId('discount_id')->nullable()->constrained();
            $table->foreignId('admin_id')->nullable()->constrained();
            $table->string('verified_code')->nullable(); // gateway verified code

            // Todo : payments maybe for a specific resource like webinar
            $table->string('resource_type')->nullable();
            $table->unsignedBigInteger('resource_id')->nullable();

            $table->timestamp('verified_at')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
