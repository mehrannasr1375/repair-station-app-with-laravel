<?php
use Illuminate\Database\Seeder;

class PrimaryUserSeeder extends Seeder
{

    public function run()
    {
        factory(App\User::class, 1)->create();
    }
}
