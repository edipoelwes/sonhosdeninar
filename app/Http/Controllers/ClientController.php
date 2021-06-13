<?php

namespace App\Http\Controllers;

use App\Models\{Adress, Client};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;

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
      if (!Auth::user()->hasPermissionTo('Cadastrar Cliente')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization.');
      }

      DB::beginTransaction();

      $client = $request->only('client_id', 'name', 'phone', 'phone_secondary', 'cpf');
      $client['company_id'] = Auth::user()->company_id;

      $adress = $request->only('zipcode', 'street', 'number', 'complement', 'neighborhood', 'state', 'city');
      $adress['company_id'] = Auth::user()->company_id;

      if ($client['client_id']) {
         $client = $this->update($client, $adress, intval($client['client_id']));
         if ($client) {
            DB::commit();
            return back()->withToastSuccess('Cliente atualizado com sucesso!');
         }
         DB::rollBack();
         return back()->withToastError('Error ao atualizar cliente!');
      }

      $client = Client::create($client);
      $adress['client_id'] = $client->id;
      $adress = Adress::create($adress);

      if ($client && $adress) {
         DB::commit();
         return back()->withToastSuccess('Cliente cadastrado com sucesso!');
      } else {
         DB::rollBack();
         return back()->withToastError('Error ao cadastrar cliente!');
      }
   }


   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Client  $client
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request)
   {
      $client = Client::select('clients.name', 'clients.cpf', 'clients.phone', 'clients.phone_secondary', 'ad.zipcode', 'ad.street', 'ad.number', 'ad.complement', 'ad.neighborhood', 'ad.state', 'ad.city')
         ->leftJoin('adresses as ad', 'ad.client_id', '=', 'clients.id')
         ->where('clients.id', $request->id)
         ->first();
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
      if (!Auth::user()->hasPermissionTo('Deletar Cliente')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization.');
      }

      $client->delete();

      return back()->withToastSuccess('Cliente removido com sucesso.');
   }


   private function update(array $clientData, array $addressData, int $id): bool
   {
      if (!Auth::user()->hasPermissionTo('Editar Cliente')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization.');
      }

      $client = Client::where('id', $id)->first();
      $adress = Adress::where('client_id', $id)->first();

      if ($client->update($clientData) && $adress->update($addressData)) {
         return true;
      }

      return false;
   }
}
