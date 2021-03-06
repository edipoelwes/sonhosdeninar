<?php

namespace App\Http\Controllers;

use App\Models\{Client};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.clients.index', [
         'clients' => Client::where('company_id', Auth::user()->company_id)->get(),
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
      $client = $request->except('_token');
      $client['company_id'] = Auth::user()->company_id;

      if ($client['client_id']) {
         $client = $this->update($client, intval($client['client_id']));
         if ($client) {
            return back()->withToastSuccess('Cliente atualizado com sucesso!');
         }
         return back()->withToastError('Error ao atualizar cliente!');
      }

      if (!Client::create($client)) {
         return back()->withToastError('Error ao cadastrar cliente!');
      }
      return back()->withToastSuccess('Cliente cadastrado com sucesso!');
   }


   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Client  $client
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request)
   {
      $client = Client::select('name', 'document', 'phone')->where('id', $request->id)->first();
      return response()->json($client);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Client  $client
    * @return \Illuminate\Http\Response
    */
   public function destroy(Client $client)
   {
      $client->delete();

      return back()->withToastSuccess('Cliente removido com sucesso.');
   }


   private function update(array $clientData, int $id): bool
   {
      $client = Client::where('id', $id)->first();

      if (!$client->update($clientData)) {
         return false;
      }

      return true;
   }
}
