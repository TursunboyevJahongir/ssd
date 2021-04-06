<?php

namespace Database\Factories;

use App\Enums\UsersGenderEnum;
use App\Models\District;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $district = $this->faker->randomElement(District::query()->get()->all());
        return [
            'address' => $this->faker->address,
            'district_id' => $district->id,
            'region_id' => $district->region_id,
            'user_id' => $this->faker->randomElement(User::query()->select('id')->get()->all()),
        ];
    }
}
