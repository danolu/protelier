<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->unique();
            $table->datetime('checkin');
            $table->datetime('checkout');
            $table->unsignedTinyInteger('adults')->default(1);
            $table->unsignedTinyInteger('children')->default(0);
            $table->text('purpose')->nullable();
            $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
            $table->unsignedInteger('charge');
            $table->unsignedInteger('discount')->default(0);
            $table->unsignedInteger('extra_charge')->default(0);
            $table->unsignedInteger('payable');
            $table->unsignedInteger('outstanding')->default(0);
            $table->unsignedInteger('deposit')->default(0);
            $table->unsignedInteger('caution')->default(0);
            $table->unsignedTinyInteger('payment_status');
            $table->unsignedTinyInteger('caution_status')->default(1);
            $table->unsignedInteger('property_damage_cost')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('car_number')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->datetime('checked_in')->nullable();
            $table->datetime('checked_out')->nullable();
            $table->datetime('cancellation_date')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
