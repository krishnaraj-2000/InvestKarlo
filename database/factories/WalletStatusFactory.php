<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WalletStatus ;
use App\Models\User ;
class WalletStatusFactory extends Factory
{
    protected $wallet_status = WalletStatus::class ;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id ,
            'status' => $this->faker->randomElement(['approved' , 'pending' , 'failed'])
        ];
    }
}
