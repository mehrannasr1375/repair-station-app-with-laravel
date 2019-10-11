<?php
/*
*  0 : repairing
*  1 : repaired
*  2 : not repairable
*  3 : no problem
*  4 : rejected by customer
*/
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateOrdersTable extends Migration
{




    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            // Table Configuraions
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_persian_ci';

            // PK && FK
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('customer_id');

            // Normal Columns
            $table->string('device_type')->nullable();
            $table->string('device_brand')->nullable();
            $table->string('device_model')->nullable();
            $table->string('device_serial')->nullable();
            $table->string('receive_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->tinyInteger('status_code')->default(0);
            $table->string('problem')->nullable();
            $table->string('problem_details')->nullable();
            $table->string('repair_info')->nullable();
            $table->string('delivery_note')->nullable();
            $table->boolean('opened_earlier')->default(false);
            $table->bigInteger('discount_amount')->default(0);
            $table->boolean('checkout')->default(false);
            $table->string('participants_csv')->nullable();

            // FK Constrates
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

        });
    }




    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
