<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    



    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            
            $table->bigIncrements('id')->autoIncrement();
            
            $table->timestamps();
            $table->string('name');
            $table->boolean('is_partner')->default(false);
            $table->unsignedBigInteger('mobile_1')->nullable();	 
            $table->unsignedBigInteger('mobile_2')->nullable();	 
            $table->unsignedBigInteger('tell_1')->nullable();	
            $table->unsignedBigInteger('tell_2')->nullable();	
            $table->string('address')->nullable();

        });
    }

    


    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
