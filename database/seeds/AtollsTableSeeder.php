<?php

use Illuminate\Support\Carbon;
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
        $atolls =
        [
            ['name' => "Alifu Alifu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Alifu Dhaalu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Baa", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Dhaalu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Faafu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Gaafu Alifu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Gaafu Dhaalu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Gnaviyani", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Haa Alifu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Haa Dhaalu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Kaafu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Laamu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Lhaviyani", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Meemu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Noonu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Raa", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Seenu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Shaviyani", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Thaa", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => "Vaavu", 'created_at'=>Carbon::now(), 'updated_at' => Carbon::now()]
    ];

    App\Atoll::insert($atolls);
        // factory(App\Atoll::class,1)->create();
    }
}
