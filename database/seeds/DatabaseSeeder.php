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
        $this->call(SpecializationsSeeder::class);
        $this->call(SponsorizationsSeeder::class);
        $this->call(SkillsSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
