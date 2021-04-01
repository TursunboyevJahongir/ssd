<?php

namespace Database\Factories;

use App\Enums\IncomeEnum;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class meFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = Income::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-30 days', '+30 days');
        return [
            'name' => $this->faker->title,
            'price' => $this->faker->numberBetween(100000,10000000),
            'type' => IncomeEnum::toArray(),
            'created_at' => Carbon::createFromTimestamp('Y-m-d H:i:s',  $date ),
            'updated_at' => Carbon::createFromTimestamp('Y-m-d H:i:s',  $date )
        ];
    }
}
