<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run()
   {
      // \App\Models\User::factory(10)->create();
      $this->call([
         CompanySeeder::class,
         UserSeeder::class,

      ]);
      \App\Models\Client::factory(30)->create();
      \App\Models\Product::factory(100)->create();
      $this->call([
         RoleSeeder::class,
         PermissionSeeder::class,
         ModelRolesSeeder::class,
         RolePermissionsSeeder::class,
      ]);
   }
}
