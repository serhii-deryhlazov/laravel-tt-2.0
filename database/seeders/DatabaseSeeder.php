<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CustomersTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CustomersTableSeeder::class);
    }
}
