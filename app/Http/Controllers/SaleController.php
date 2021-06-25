<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{Client, LotItem, Product, Quota, Recipe, Sale, SaleProduct, User};

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
   public function store(SaleRequest $request)
   {
      DB::beginTransaction();
      $sale = $request->except(['price_subtotal', 'price', 'amount', '_token']);
      $sale['company_id'] = Auth::user()->company_id;
      $sale['user_id'] = Auth::user()->id;
      $sale['sale_date'] = date('d/m/Y', strtotime($request->sale_date));

      $sale_id = Sale::create($sale);

      $user = User::where('id', Auth::user()->id);
      if(Auth::user()->can('Fototica Macedo')) {
         if($request->receitas) {
            $recipes = [];
            foreach($request->allFiles()['receitas'] as $file) {
               $recipe['sale_id'] = $sale_id->id;
               $recipe['path'] = $file->store('recipes/'.$sale_id->id);
               array_push($recipes, $recipe);
            }
            $recipe_id = Recipe::insert($recipes);
         }
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

      if ($request->payment_method == 1 || $request->payment_method == 2) {
         $quotas = [];
         $payout_interval = 0;
         for ($i = 0; $i < $request->quota; $i++) {
            $quota['company_id'] = Auth::user()->company_id;
            $quota['sale_id'] = $sale_id->id;
            $quota['quota'] = $i + 1;
            $quota['payment_status'] = $request->status;

            if ($request->payment_method == 1 || $request->payment_method == 2) {
               $quota['due_date'] = date('Y-m-d', strtotime("+$i month", strtotime($request->due_date)));
            }

            array_push($quotas, $quota);
         }

         $quota_id = Quota::insert($quotas);
      }

      if ($sale_id && $sale_products) {
         DB::commit();
         return redirect()->route('sales.index')->withToastSuccess('Venda registrada com sucesso!');
      } else {
         DB::rollBack();
         redirect()->route('sales.index')->withToastSuccess('Erro ao Registrar venda!');
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
      $quotas = Quota::where('sale_id', $sale->id)->orderBy('id')->get();
      return view('admin.sales.show', [
         'sale' => $sale,
         'quotas' => $quotas
      ]);
   }

   public function updateQuota(Request $request)
   {
      $quota = Quota::where('id', $request->id)->first();

      $quota->payment_status = $request->payment_status;

      if ($quota->save()) {
         $quotas = Quota::where([
            ['sale_id', $quota->sale_id],
            ['company_id', Auth::user()->company_id]
         ])->whereIn('payment_status', [2, 3])->get();

         if (count($quotas) == 0) {
            $sale = Sale::where('id', $quota->sale_id)->first();
            $sale->status = 1;
            $sale->save();
         }
         return back()->withToastSuccess('Parcela faturada com sucesso!');
      }

      return back()->withToastError('Error ao faturar parcela!');
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
