<?php

namespace Database\Factories;

use App\Enums\IncomeEnum;
use App\Models\Cost;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = Cost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-60 days');
        return [
            'name' => $this->faker->title,
            'price' => $this->faker->numberBetween(100000,10000000),
            'created_at' => $date->format('Y-m-d H:i:s'),
            'updated_at' => $date->format('Y-m-d H:i:s')
        ];
    }
}
