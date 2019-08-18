<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement(); // primary-key
            $table->timestamps();
            $table->string('name');
            $table->tinyInteger('is_partner')->default(0);
            $table->unsignedBigInteger('mobile_1');	 //max 11
            $table->unsignedBigInteger('mobile_2');	 
            $table->unsignedBigInteger('tell_1');	 //max 13
            $table->unsignedBigInteger('tell_2');	
            $table->string('address');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
