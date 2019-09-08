<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CustomersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
    }
}
