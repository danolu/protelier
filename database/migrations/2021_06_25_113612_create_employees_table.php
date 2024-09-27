<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('phone', 18)->nullable();
            $table->string('email')->nullable(); 
            $table->text('address')->nullable();
            $table->string('designation')->nullable();
            $table->unsignedBigInteger('salary')->nullable();
            $table->string('bank_name')->nullable();
            $table->unsignedBigInteger('bank_account_number')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
