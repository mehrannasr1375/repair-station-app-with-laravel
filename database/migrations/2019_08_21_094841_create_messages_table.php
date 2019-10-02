<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{




    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->autoIncrement();
            $table->bigInteger('customer_id');
            $table->bigInteger('order_id');

            $table->string('text');
            $table->dateTime('send_time');
            $table->boolean('delivered')->default(false);

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }




    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
