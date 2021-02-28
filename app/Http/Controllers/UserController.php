<?php

namespace App\Http\Controllers;

use App\Models\{User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth};

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

      $user['company_id'] = !$user['company_id'] ? $user['company_id'] = Auth::user()->company_id : $user['company_id'];
      $data = User::create($user);

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
   public function edit(Request $request) {

      $user = User::select('company_id', 'name', 'email', 'document', 'phone')-> where('id', $request->id)->first();
      return response()->json($user);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, User $user)
   {
      $data = $request->all();

      $user->update($data);

      return back()->withToastSuccess('Usuário atualizado com sucesso!');
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
}
