<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->autoIncrement();
            $table->bigInteger('order_id');

            $table->string('key');
            $table->bigInteger('amount')->nullable();
            $table->string('info')->nullable();

            $table->foreign('order_id')->references('id')->on('orders');

        });
    }




    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
