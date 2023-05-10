<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\BankData;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        Customer::factory()
            ->count(5)
            ->create()
            ->each(function ($customer) {
                $customer->bankData()->save(BankData::factory()->make());
            });
    }
}
