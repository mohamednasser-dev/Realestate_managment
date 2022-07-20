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
        // $this->call(UserSeeder::class);
         $this->call(BranchesSeeder::class);
         $this->call(AdminSeeder::class);
         $this->call(MainDataSeeder::class);
         $this->call(AboutSeeder::class);
         $this->call(ManagerWordsSeeder::class);
         $this->call(MapSeeder::class);
    }
}
