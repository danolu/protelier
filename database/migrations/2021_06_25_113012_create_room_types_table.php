<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('rate');
            $table->unsignedInteger('caution')->default(0);
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('number_of_beds')->default(1);
            $table->string('bed_type')->nullable();
            $table->unsignedTinyInteger('adult_capacity');
            $table->unsignedTinyInteger('children_capacity');
            $table->text('images')->nullable();
            $table->text('facilities')->nullable();
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
        Schema::dropIfExists('room_types');
    }
}
