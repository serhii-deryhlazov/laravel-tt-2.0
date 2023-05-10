<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BankData;

class BankDataFactory extends Factory
{
    protected $model = BankData::class;

    public function definition()
    {
        return [
            'bank_name' => 'Bank XYZ',
            'account_number' => 'ACCT' . $this->faker->randomNumber(4),
            'account_age' => $this->faker->numberBetween(1, 12),
        ];
    }
}
