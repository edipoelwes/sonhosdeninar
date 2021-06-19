<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{Client, LotItem, Product, Recipe, Sale, SaleProduct, User};

class SaleController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $sales = Sale::where('company_id', Auth::user()->company_id)->get();

      return view('admin.sales.index', [
         'sales' => $sales
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
            ['id' => 1, 'name' => 'Boleto Bancario'],
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
      DB::beginTransaction();
      $sale = $request->except(['price_subtotal', 'price', 'amount', '_token']);
      $sale['company_id'] = Auth::user()->company_id;
      $sale['user_id'] = Auth::user()->id;
      $sale['sale_date'] = date('d/m/Y', strtotime($request->sale_date));

      $sale_id = Sale::create($sale);

      $user = User::where('id', Auth::user()->id);
      if(Auth::user()->can('Fototica Macedo')) {
         $recipes = [];
         foreach($request->allFiles()['receitas'] as $file) {
            $recipe['sale_id'] = $sale_id->id;
            $recipe['path'] = $file->store('recipes/'.$sale_id->id);
            array_push($recipes, $recipe);
         }

         $recipe_id = Recipe::insert($recipes);
      }


      $itens = $request->only(['price_subtotal', 'price', 'amount']);

      $sale_itens = [];
      foreach($itens['amount'] as $key => $item) {
         $data['company_id'] = Auth::user()->company_id;
         $data['sale_id'] = $sale_id->id;
         $data['lot_item_id'] = $key;
         $data['amount'] = $itens['amount'][$key];
         $data['subtotal'] = $itens['price_subtotal'][$key];

         array_push($sale_itens, $data);
      }

      $sale_products = SaleProduct::insert($sale_itens);

      if($sale_products) {
         foreach($sale_itens as $item) {
            $lot_item = LotItem::where('id', $item['lot_item_id'])->first();
            $lot_item->amount -= $item['amount'];
            $lot_item->save();
         }
      }

      if (Auth::user()->can('Fototica Macedo')) {
         if ($sale_id && $sale_products && $recipe_id) {
            DB::commit();
            return redirect()->route('sales.index')->withToastSuccess('Venda registrada com sucesso!');
         } else {
            DB::rollBack();
            redirect()->route('sales.index')->withToastSuccess('Erro ao Registrar venda!');
         }
      } else {
         if ($sale_id && $sale_products) {
            DB::commit();
            return redirect()->route('sales.index')->withToastSuccess('Venda registrada com sucesso!');
         } else {
            DB::rollBack();
            redirect()->route('sales.index')->withToastSuccess('Erro ao Registrar venda!');
         }
      }
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Sale  $sale
    * @return \Illuminate\Http\Response
    */
   public function show(Sale $sale)
   {
      return view('admin.sales.show', [
         'sale' => $sale
      ]);
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
      $sale->status = $request->status;

      if($request->status == '3') {
         $products = SaleProduct::where([
            ['company_id', Auth::user()->company_id],
            ['sale_id', $sale->id]
         ])->select('lot_item_id as item', 'amount')->get();

        foreach ($products as $product) {
           $lot_item = LotItem::where('id', $product->item)->first();
           $lot_item->amount += $product->amount;
           $lot_item->save();
        }
      }

      if($sale->save()) {
         return back()->withToastSuccess('Status atualizado com sucesso!');
      }
      return back()->withToastError('Error ao atualizar status!');
   }
}
