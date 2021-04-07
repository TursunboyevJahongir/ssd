<?php

namespace Database\Factories;

use App\Enums\UsersGenderEnum;
use App\Models\Prisoner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PrisonerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = Prisoner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement(User::query()->select('id')->get()->all()),
            'imprisonment_regime' => $this->faker->text,
            'term' => $this->faker->randomElement(['3 oy','6 oy','1 yil','3 yil','5 yil','15 yil','bir umirga']),
            'start_of_term' => $this->faker->dateTimeBetween('-15 year')->format('Y-m-d'),
            'end_of_term' => $this->faker->dateTimeBetween('-15 year','30 year')->format('Y-m-d'),
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
