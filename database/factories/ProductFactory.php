<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
   /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = Product::class;

   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      return [
         'company_id' => $this->faker->numberBetween(1, 2),
         // 'category' => "fraldas",
         'category' => $this->faker->randomElement(['fraldas', 'lenços', 'roupas', 'calçados', 'higiene', 'enxoval']),
         'brand' => $this->faker->randomElement(['mamypoko', 'pampers', 'huggies', 'pompom', 'babysec', 'scoobydoo']),
         'size' => $this->faker->randomElement(['rn', 'p', 'm', 'g', 'xg', 'xxg', 'grandinhos']),
         'name' => $this->faker->sentence(4),
         // 'price' => $this->faker->randomFloat(1, 2, 10),
         'amount' => $this->faker->numberBetween(1, 30),
         'min_amount' => $this->faker->numberBetween(4, 10),
      ];
   }
}
