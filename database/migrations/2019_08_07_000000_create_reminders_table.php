<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemindersTable extends Migration
{

    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {

            // Table Configuraions
            $table->charset = 'utf8';
            $table->collation = 'utf8_persian_ci';

            // PK
            $table->bigIncrements('id');

            // Normal Columns
            $table->string('title')->nullable();
            $table->tinyInteger('status_code')->default(1);
            $table->string('description')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();

        });
    }


    public function down()
    {
        Schema::dropIfExists('reminders');
    }
}
