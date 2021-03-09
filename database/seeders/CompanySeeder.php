<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('companies')->insert([
      [
        'social_name' => 'Sonhos de Ninar LTDA',
        'alias_name' => 'Sonhos de Ninar',
        'cnpj' => '96564196000116',
        'inscricao_estadual' => '582576512',
        /** address */
        'zipcode' => '64071320',
        'street' => 'Rua Cristo Redentor',
        'number' => '609',
        'neighborhood' => 'Três Andares',
        'state' => 'PI',
        'city' => 'Teresina',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
         'social_name' => 'Fototica Macedo LTDA',
         'alias_name' => 'Fototica Macedo',
         'cnpj' => '72860540000156',
         'inscricao_estadual' => '779584139',
         /** address */
         'zipcode' => '64212800',
         'street' => 'Rua Cristo Redentor',
         'number' => '357',
         'neighborhood' => 'Três Andares',
         'state' => 'PI',
         'city' => 'Teresina',
         'created_at' => now(),
         'updated_at' => now(),
       ],
    ]);
  }
}
