<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('permissions')->insert([
         ['name' => 'Super Usuario',       'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         ['name' => 'Cadastrar Cliente',   'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Cliente',      'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Clientes', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Cliente',     'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         ['name' => 'Fototica Macedo',     'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Sonhos de Ninar',     'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
      ]);
   }
}
