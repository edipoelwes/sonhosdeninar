<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\{Permission};

class PermissionController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.permissions.index', [
         'permissions' => Permission::all(),
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
      $permission = Permission::where('name', $request->name)->get();
      if ($permission->count() > 0) {
         return back()->withToastWarning('Permissão ja existe!');
      }

      $permission = $request->except('_token');

      if ($request->permission_id) {
         $permission = $this->update($permission, intval($request->permission_id));

         if ($permission) {
            return back()->withToastSuccess('Permissão atualizada com sucesso!');
         }

         return back()->withToastError('Error ao atualizar Permissão!');
      }

      if (!Permission::create($request->all())) {
         return back()->withToastError('Error ao cadastradar permissão!');
      }

      return back()->withToastSuccess('Permissão cadastrada com Sucesso!');
   }
   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

   public function edit(Request $request)
   {
      $permission = Permission::select('name')->where('id', $request->id)->first();

      return response()->json($permission);
   }


   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $permission = Permission::where('id', $id)->first();
      if (!$permission->delete()) {
         return back()->withToastError('Error ao excluir permissão!');
      }

      return back()->withToastSuccess('Permissão excluída com sucesso!');
   }

   private function update(array $permissionData, $id)
   {
      $permission = Permission::where('id', $id)->first();

      if (!$permission->update($permissionData)) {
         return false;
      }

      return true;
   }
}
