<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->bigInteger('customer_id'); //FK
            $table->bigInteger('order_id'); //FK
            
            $table->string('text');
            $table->dateTime('send_time');
            $table->boolean('delivered')->default(false);

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
