<?php

namespace App\Http\Controllers;

use App\Models\{User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth};

class AuthController extends Controller
{
   public function loginForm()
   {
      if (Auth::check() === true) {
         return redirect()->route('home');
      }

      return view('login');
   }

   public function login(Request $request)
   {

      if (in_array('', $request->only('email', 'password'))) {
         $json['message'] = 'Informe todos os dados para efetuar o login';
         return response()->json($json);
      }

      if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
         $json['message'] = 'Informe um e-mail válido!';
         return response()->json($json);
      }

      $credentials = [
         'email' => $request->email,
         'password' => $request->password
      ];

      if (!Auth::attempt($credentials)) {
         $json['message'] = 'Usário e senha não conferem';
         return response()->json($json);
      }

      $this->authenticate($request->getClientIp());

      $json['redirect'] = route('home');
      return response()->json($json);
   }

   public function logout()
   {
      Auth::logout();
      return redirect()->route('login');
   }

   private function authenticate(string $ip)
   {
      $user = User::where('id', Auth::user()->id);
      $user->update([
         'last_login_at' => date('Y-m-d H:i:s'),
         'last_login_ip' => $ip
      ]);
   }
}
