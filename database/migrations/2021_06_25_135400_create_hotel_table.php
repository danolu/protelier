<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->string('phone');
            $table->string('alt_phone')->nullable();
            $table->string('email');
            $table->string('alt_email')->nullable();
            $table->text('address');
            $table->string('website')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->unsignedBigInteger('account_number')->nullable();
            $table->text('terms')->nullable();
            $table->unsignedTinyInteger('loyalty_fraction')->default(5);
            $table->unsignedTinyInteger('loyalty_status')->default(1);
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
        Schema::dropIfExists('hotel');
    }
}
