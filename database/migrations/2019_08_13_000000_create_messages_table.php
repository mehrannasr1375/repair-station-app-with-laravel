<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{




    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

            // Table Configuraions
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_persian_ci';

            // PK && FK
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('order_id');

            // Normal Columns
            $table->string('text');
            $table->dateTime('send_time');
            $table->boolean('delivered')->default(false);

            // FK Constrates
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }




    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
