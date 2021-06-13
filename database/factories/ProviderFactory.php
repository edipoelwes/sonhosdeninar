<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
   /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = Provider::class;

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
         'cnpj' => $this->faker->unique()->numberBetween(10000000000000, 99999999999999),
         'phone' => $this->faker->numberBetween(86994000000, 86994999999)
      ];
   }
}
