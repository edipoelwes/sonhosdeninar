<?php

namespace App\Http\Controllers;

use App\Models\{Client, LotItem, Product, Sale};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth};

class SaleController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.sales.index', [
         'sales' => Sale::where('company_id', Auth::user()->company_id)->get()
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $products = LotItem::where([
         ['company_id', Auth::user()->company_id],
         ['amount', '>', 0]
      ])->get();

      return view('admin.sales.form', [
         'clients' => Client::where('company_id', Auth::user()->company_id)->get(),
         'products' => $products,
         'payment_methods' => [
            ['id' => 2, 'name' => 'Cartão de credito'],
            ['id' => 3, 'name' => 'Transferência Bancaria'],
            ['id' => 4, 'name' => 'Dinheiro']
         ],
         'status' =>  [
            ['id' => 1, 'name' => 'Confirmado'],
            ['id' => 2, 'name' => 'Pendente'],
         ]
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
      dd($request->all());
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Sale  $sale
    * @return \Illuminate\Http\Response
    */
   public function show(Sale $sale)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Sale  $sale
    * @return \Illuminate\Http\Response
    */
   public function edit(Sale $sale)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Sale  $sale
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Sale $sale)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Sale  $sale
    * @return \Illuminate\Http\Response
    */
   public function destroy(Sale $sale)
   {
      //
   }
}
