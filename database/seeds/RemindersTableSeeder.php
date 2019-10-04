<?php
use Illuminate\Database\Seeder;

class RemindersTableSeeder extends Seeder
{

    public function run()
    {
        factory(App\Reminder::class, 10)->create();
    }
}
