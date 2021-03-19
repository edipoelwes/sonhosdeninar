<?php

namespace App\Http\Controllers;

use App\Models\{PaymentMethod, Product, Purchase};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $purchases = Purchase::where('company_id', Auth::user()->company_id)->get();


      return view('admin.purchases.index', [
         'purchases' => $purchases,
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      // $paymentMethods = PaymentMethod::all(['id', 'name']);
      return view('admin.purchases.form', [
         'products' => Product::where('company_id', Auth::user()->company_id)->get(),
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
    * @param  \App\Models\Purchase  $purchase
    * @return \Illuminate\Http\Response
    */
   public function show(Purchase $purchase)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Purchase  $purchase
    * @return \Illuminate\Http\Response
    */
   public function edit(Purchase $purchase)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Purchase  $purchase
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Purchase $purchase)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Purchase  $purchase
    * @return \Illuminate\Http\Response
    */
   public function destroy(Purchase $purchase)
   {
      //
   }
}
