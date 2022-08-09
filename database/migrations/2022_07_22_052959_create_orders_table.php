<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id');
            $table->foreignId('user_id');
            $table->integer('product_id');
            $table->integer('total');
            $table->integer('price');
            $table->string('receiver');
            $table->string('phone');
            $table->string('alamat');
            $table->foreignId('city_id');
            $table->string('berat');
            $table->string('courier');
            $table->string('paket');
            $table->integer('total_price');
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
        Schema::dropIfExists('orders');
    }
}
