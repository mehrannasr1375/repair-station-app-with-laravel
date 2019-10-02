<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(PrimaryUserSeeder::class);
        $this->call(RemindersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
    }
}
