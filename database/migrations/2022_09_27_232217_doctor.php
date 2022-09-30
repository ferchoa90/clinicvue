<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('lastname', 80);
            $table->longText('address');
            $table->unsignedInteger('specialty');
            $table->string('bloodtype', 3);
            $table->string('cellphone',10);
            $table->unsignedInteger('country');
            $table->unsignedInteger('state');
            $table->unsignedInteger('city');
            $table->tinyInteger('status')->default(1);
            $table->unsignedInteger('user_cre');
            $table->unsignedInteger('user_upd')->nullable();
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
        Schema::dropIfExists('doctor');
    }
};
