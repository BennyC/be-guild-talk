<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'token' => $this->faker->uuid(),
            'is_preferred' => false,
        ];
    }

    public function preferred(): PaymentMethodFactory
    {
        return $this->state(fn ($attrs) => [
            'is_preferred' => true,
        ]);
    }
}
