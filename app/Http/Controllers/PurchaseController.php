<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{PaymentMethod, Product, Provider, Purchase, PurchaseProduct, Quota};

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
      $status = [
         ['id' => 1, 'name' => 'Confirmado'],
         ['id' => 2, 'name' => 'Pendente'],
      ];

      return view('admin.purchases.form', [
         'products' => Product::where('company_id', Auth::user()->company_id)->get(),
         'providers' => Provider::where('company_id', Auth::user()->company_id)->get(),
         'status' => $status
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

      $purchase = $request->only(['status', 'payment_method', 'note', 'purchase_date', 'quota']);
      $purchase['company_id'] = Auth::user()->company_id;
      $purchase['user_id'] = Auth::user()->id;
      $purchase['provider_id'] = intval($request->provider_id);

      $purchase_id = Purchase::create($purchase);

      $products = $request->only(['price', 'amount', 'profit']);

      $itens = [];
      foreach ($products['price'] as $key => $product) {
         $data['company_id'] = Auth::user()->company_id;
         $data['purchase_id'] = $purchase_id->id;
         $data['product_id'] = $key;

         $data['sub_total'] = $products['price'][$key];
         $data['amount'] = $products['amount'][$key];

         array_push($itens, $data);
      }

      $purchase_product = PurchaseProduct::insert($itens);

      $total = array_sum($products['price']);
      $valor_parcela = $total / intval($request->quota) ?? 1;

      $quotas = [];
      for ($i = 0; $i < $request->quota; $i++) {
         $quota['company_id'] = Auth::user()->company_id;
         $quota['purchase_id'] = $purchase_id->id;
         $quota['quota'] = $i + 1;
         $quota['price'] = $valor_parcela;
         $quota['due_date'] = date('Y-m-d', strtotime("+$i month", strtotime($request->due_date)));
         array_push($quotas, $quota);
      }

      $quota_id = Quota::insert($quotas);

      if ($purchase_id && $purchase_product) {
         DB::commit();
         return redirect()->route('purchases.index')->withToastSuccess('Compra Cadastrada com sucesso!');
      } else {
         DB::rollBack();
         redirect()->route('purchases.index')->withToastSuccess('Erro ao Cadastradar compra!');
      }
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Purchase  $purchase
    * @return \Illuminate\Http\Response
    */
   public function show(Purchase $purchase)
   {
      return view('admin.purchases.show', [
         'purchase' => $purchase
      ]);
   }
}
