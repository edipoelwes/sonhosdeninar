<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\{Role};

class RoleController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.roles.index', [
         'roles' => Role::all()
      ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $role = Role::where('name', $request->name)->get();
      if ($role->count() > 0) {
         return back()->withToastWarning('Perfil ja existe!');
      }

      $role = $request->except('_token');

      if ($request->role_id) {
         $role = $this->update($role, intval($request->role_id));

         if ($role) {
            return back()->withToastSuccess('Perfil atualizado com sucesso!');
         }

         return back()->withToastError('Error ao atualizar perfil!');
      }

      if (!Role::create($request->all())) {
         return back()->withToastError('Perfil cadastrado com Sucesso!');
      }

      return back()->withToastSuccess('Perfil cadastrado com Sucesso!');
   }


   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request)
   {
      $role = Role::select('name')->where('id', $request->id)->first();

      return response()->json($role);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $role = Role::where('id', $id)->first();
      if (!$role->delete()) {
         return back()->withToastError('Error ao excluir perfil!');
      }

      return back()->withToastSuccess('Perfil excluído com sucesso!');
   }

   private function update(array $roleData, int $id)
   {
      $role = Role::where('id', $id)->first();

      if (!$role->update($roleData)) {
         return false;
      }

      return true;
   }
}
