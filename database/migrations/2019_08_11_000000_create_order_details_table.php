<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {

            // Table Configuraions
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_persian_ci';

            // PK && FK
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('order_id');

            // Normal Columns
            $table->string('key');
            $table->bigInteger('user_amount')->nullable();
            $table->bigInteger('shop_amount')->nullable();

            // FK Constrates
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }




    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
