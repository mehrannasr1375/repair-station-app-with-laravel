<?php

use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{
    
    public function run()
    {
        factory(App\OrderDetail::class, 5)->create();
    }
}
