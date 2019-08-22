<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    
    public function run()
    {
        factory(\App\Payment::class, 5)->create();
    }
}
