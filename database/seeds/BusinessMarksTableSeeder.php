<?php

use Illuminate\Database\Seeder;

class BusinessMarksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $businessMarks = factory(\App\BusinessMark::class, 10)->create();
    }
}
