<?php

use App\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(PrimaryUserSeeder::class);
        $this->call(RemindersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
