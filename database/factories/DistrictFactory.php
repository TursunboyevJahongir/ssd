<?php

namespace Database\Factories;

use App\Enums\UsersGenderEnum;
use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistrictFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = District::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetName,
            'region_id' => $this->faker->randomElement(Region::query()->select('id')->get()->all()),
        ];
    }
}
