<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SoldProduct>
 */
class SoldProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
    // protected $fillable = ['name','price','qty','product_id','order_id','user_id'];

        return [
            'name'=>fake()->name(),
            'price'=>fake()->randomDigit(),
            'qty'=>fake()->randomDigit(),
            'order_id'=>1,
            'user_id'=>1,
            'product_id'=>1,

        ];
    }
}
