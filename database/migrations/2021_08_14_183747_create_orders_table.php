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
            $table->string('order_no')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->on('users')->references('id');
            $table->text('shipping_address')->nullable();
            $table->string('client_name')->nullable();
            $table->string('email')->nullable();
            $table->dateTime('order_time')->default(\Carbon\Carbon::now());
            $table->double('total')->nullable();
            $table->enum('order_status', ['pending', 'done', 'cancel', 'delete']);
            $table->enum('payment_status', ['pending', 'done']);
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
