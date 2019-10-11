<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{



    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {

            // table configuraions
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_persian_ci';

            // PK && FK
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('order_id');

            // Normal Columns
            $table->bigInteger('amount')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('date')->nullable();

            // FK Constrates
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }




    public function down()
    {
        Schema::dropIfExists('payments');
    }



}
