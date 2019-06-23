<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*- Image
- Room Name
- Room Type
- Room Capacity*/
            $table->string('name');
            $table->unsignedBigInteger('room_type_id');
            $table->unsignedBigInteger('room_capacity_id');
            $table->string('room_image');
            $table->unsignedBigInteger('room_price_id');
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
        Schema::dropIfExists('rooms');
    }
}
