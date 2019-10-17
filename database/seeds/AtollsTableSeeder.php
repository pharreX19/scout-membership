<?php

use Illuminate\Database\Seeder;

class AtollsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Atoll::class,1)->create();
    }
}
