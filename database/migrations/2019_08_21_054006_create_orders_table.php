<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->bigInteger('customer_id'); //FK
            //$table->timestamps();

            $table->string('device_type')->nullable();
            $table->string('device_brand')->nullable();
            $table->string('device_model')->nullable();
            $table->string('device_serial')->nullable();
            $table->dateTime('receive_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->tinyInteger('status_code');
            $table->string('problem')->nullable();
            $table->string('problem_details')->nullable();
            $table->string('repair_info')->nullable();
            $table->string('delivery_note')->nullable();
            $table->boolean('opened_earlier')->default(false);
            $table->bigInteger('discount_amount')->nullable();
            $table->boolean('checkout')->default(false);
            $table->string('participants_csv')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
