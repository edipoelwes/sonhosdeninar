<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
      $products = Product::where([
         ['category', $request->category],
         ['company_id', Auth::user()->company_id]
      ])->get();

      return view('admin.products.index', [
         'products' => $products,
         'category' => ucfirst($request->category)
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
      $product = $request->except('_token');
      $product['company_id'] = Auth::user()->company_id;

      if ($product['product_id']) {
         $product = $this->update($product, intval($product['product_id']));
         if ($product) {
            return back()->withToastSuccess('Item atualizado com sucesso!');
         }
         return back()->withToastError('Error ao atualizar Item!');
      }

      if (!Product::create($product)) {
         return back()->withToastError('Error ao cadastrar Item!');
      }
      return back()->withToastSuccess('Item cadastrado com sucesso!');
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request)
   {
      $product = Product::where('id', $request->id)->first();

      return response()->json($product);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
   public function destroy(Product $product)
   {
      $product->delete();

      return back()->withToastSuccess('Produto removido com sucesso.');
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
   private function update(array $productData, int $id): bool
   {
      $product = Product::where('id', $id)->first();

      if (!$product->update($productData)) {
         return false;
      }

      return true;
   }

   public function product(Request $request)
   {
      $product = Product::where([
         ['id', $request->id],
         ['company_id', Auth::user()->company_id]
      ])->first();
      return response()->json($product);
   }
}
