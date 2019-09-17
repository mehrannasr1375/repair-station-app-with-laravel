<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    


    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->autoIncrement();
            $table->bigInteger('order_id');

            $table->bigInteger('amount')->nullable();
            $table->string('payment_type')->nullable();
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('order_id')->references('id')->on('orders');

        });
    }

   
    

    public function down()
    {
        Schema::dropIfExists('payments');
    }



}
