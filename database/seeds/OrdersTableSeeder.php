<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    
    public function run()
    {
        factory(App\Order::class, 5)->create();
    }
}
