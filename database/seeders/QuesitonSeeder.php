<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuesitonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Question::factory(100)->create();
    }
}
