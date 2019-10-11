<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{

    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {

            // Normal Columns
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();

        });
    }


    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
