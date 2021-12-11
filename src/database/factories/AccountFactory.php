<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'aws_id' => $this->faker->word,
        'arn' => $this->faker->word,
        'email' => $this->faker->word,
        'name' => $this->faker->word,
        'status' => $this->faker->word,
        'joined_method' => $this->faker->word,
        'joined_at' => $this->faker->date('Y-m-d H:i:s'),
        'aws_access_key_id' => $this->faker->word,
        'aws_secret_access_key' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
