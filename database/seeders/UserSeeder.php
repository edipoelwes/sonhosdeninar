<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Hash};

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      [
        'company_id'     => 1,
        'name'           => 'Edipo Elwes',
        'cpf'            => '03570590348',
        'email'          => 'edipoelwes2@gmail.com',
        'password'       => Hash::make('12345678'),
        'remember_token' => Str::random(10),
        'created_at'     => now(),
        'updated_at'     => now(),
      ],
      [
        'company_id'     => 1,
        'name'           => 'Jessianne Saiara',
        'cpf'            => '03570590355',
        'email'          => 'saiaraj2006@gmail.com',
        'password'       => Hash::make('12345678'),
        'remember_token' => Str::random(10),
        'created_at'     => now(),
        'updated_at'     => now(),
      ],
      [
         'company_id'     => 2,
         'name'           => 'Jessiele Samila',
         'cpf'            => '03570590382',
         'email'          => 'siele@gmail.com',
         'password'       => Hash::make('12345678'),
         'remember_token' => Str::random(10),
         'created_at'     => now(),
         'updated_at'     => now(),
       ],
       [
         'company_id'     => 2,
         'name'           => 'Hitalo Vieira',
         'cpf'            => '03570552321',
         'email'          => 'hitalo@gmail.com',
         'password'       => Hash::make('12345678'),
         'remember_token' => Str::random(10),
         'created_at'     => now(),
         'updated_at'     => now(),
       ],
    ]);
  }
}
