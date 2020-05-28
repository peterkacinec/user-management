<?php

namespace KornerBI\UserManagement\Database\Seeds;

use Illuminate\Database\Seeder;
use KornerBI\UserManagement\Database\Seeds;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(Seeds\RoleSeeder::class);
    }
}
