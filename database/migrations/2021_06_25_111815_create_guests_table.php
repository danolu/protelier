<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('salutation')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone', 18);
            $table->text('address')->nullable();
            $table->string('emergency_contact', 18)->nullable();
            $table->string('nin')->nullable();
            $table->unsignedBigInteger('outstanding')->default(0);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('loyalty_points')->default(0);
            $table->unsignedBigInteger('redeemed_loyalty_points')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
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
        Schema::dropIfExists('guests');
    }
}
