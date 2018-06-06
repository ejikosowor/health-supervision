<?php

use Illuminate\Database\Seeder;

class SubscribersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Subscriber::class, 10)->create();        
    }
}