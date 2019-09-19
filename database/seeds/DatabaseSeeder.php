<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        butun fieldleri columnlari mass asignment elemekcun
//        Model::unguard();
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AdminUsersSeeder::class);
//        Model::reguard();
    }
}
