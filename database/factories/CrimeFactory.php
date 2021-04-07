<?php

namespace Database\Factories;

use App\Enums\UsersGenderEnum;
use App\Models\Crime;
use App\Models\Law;
use App\Models\Prisoner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = Crime::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prisoner_id' => $this->faker->randomElement(Prisoner::query()->select('id')->get()->all()),
            'law_id' => $this->faker->randomElement(Law::query()->select('id')->get()->all()),
        ];
    }
}
