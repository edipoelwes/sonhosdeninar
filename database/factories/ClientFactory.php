<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
   /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = Client::class;

   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      return [
         'company_id' => $this->faker->numberBetween(1, 2),
         'name' => $this->faker->name,
         'cpf' => $this->faker->unique()->numberBetween(10000000000, 99999999999),
         'phone' => $this->faker->numberBetween(86994000000, 86994999999)
      ];
   }
}
