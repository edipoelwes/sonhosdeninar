<?php

namespace App\Http\Controllers;

use App\Models\{User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth};
use Spatie\Permission\Models\{Role};
// use Spatie\Permission\Exceptions\UnauthorizedException;

class UserController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $users = User::with('company')->where('company_id', Auth::User()->company_id)->get();

      return view('admin.users.index', [
         'users' => $users
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
      $user = $request->except('_token');
      $user['company_id'] = Auth::user()->company_id;

      if ($user['user_id']) {
         $user = $this->update($user, intval($user['user_id']));
         if ($user) {
            return back()->withToastSuccess('Usuário atualizado com sucesso!');
         }
         return back()->withToastError('Error ao atualizar usuário!');
      }

      if (!User::create($user)) {
         return back()->withToastError('Error ao cadastrar usuário!');
      }
      return back()->withToastSuccess('Usuário cadastrado com sucesso!');
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
   public function show(User $user)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request)
   {

      $user = User::where('id', $request->id)->first();
      return response()->json($user);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
   public function destroy(User $user)
   {
      if ($user == auth()->user()) {
         return back()->withToastError('Oops, Não é permitido remover o próprio usuário!');
      }

      $user->delete();

      return back()->withToastSuccess('Usuário removido com sucesso.');
   }

   public function roles($user)
   {
      $user = User::where('id', $user)->first();
      $roles = Role::all();

      foreach ($roles as $role) {
         if ($user->hasRole($role->name)) {
            $role->can = true;
         } else {
            $role->can = false;
         }
      }
      return view('admin.users.roles', [
         'user' => $user,
         'roles' => $roles,
      ]);
   }

   public function rolesSync(Request $request, $user)
   {
      $rolesRequest = $request->except(['_token', '_method']);

      foreach ($rolesRequest as $key => $value) {
         $roles[] = Role::where('id', $key)->first();
      }

      $user = User::where('id', $user)->first();

      if (!empty($roles)) {
         $user->syncRoles($roles);
      } else {
         $user->syncRoles(null);
      }
      return redirect()->route('users.roles', [
         'user' => $user->id,
      ])->withToastSuccess('Perfil sincronizado com sucesso!');
   }

   private function update(array $userData, int $id): bool
   {
      $user = User::where('id', $id)->first();

      if (!$user->update($userData)) {
         return false;
      }

      return true;
   }
}
