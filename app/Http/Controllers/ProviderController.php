<?php

namespace App\Http\Controllers;

use App\Models\{Provider};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.providers.index', [
         'providers' => Provider::where('company_id', Auth::user()->company_id)->get(),
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
      $provider = $request->except('_token');
      $provider['company_id'] = Auth::user()->company_id;

      if ($provider['provider_id']) {
         $provider = $this->update($provider, intval($provider['provider_id']));
         if ($provider) {
            return back()->withToastSuccess('Fornecedor atualizado com sucesso!');
         }
         return back()->withToastError('Error ao atualizar fornecedor!');
      }

      if (!Provider::create($provider)) {
         return back()->withToastError('Error ao cadastrar fornecedor!');
      }
      return back()->withToastSuccess('Fornecedor cadastrado com sucesso!');
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Provider  $provider
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request)
   {
      $provider = Provider::select('name', 'cnpj', 'phone')->where('id', $request->id)->first();
      return response()->json($provider);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Provider  $provider
    * @return \Illuminate\Http\Response
    */
   public function destroy(Provider $provider)
   {
      $provider->delete();

      return back()->withToastSuccess('Fornecedor removido com sucesso.');
   }

   private function update(array $providerData, int $id): bool
   {
      $provider = Provider::where('id', $id)->first();

      if (!$provider->update($providerData)) {
         return false;
      }

      return true;
   }
}
