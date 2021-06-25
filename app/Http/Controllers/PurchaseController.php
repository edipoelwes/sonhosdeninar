<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{Lot, LotItem, PaymentMethod, Product, Provider, Purchase, PurchaseProduct, Quota};

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
      return view('admin.purchases.form', [
         'products' => Product::where('company_id', Auth::user()->company_id)->get(),
         'providers' => Provider::where('company_id', Auth::user()->company_id)->get(),
         'payment_methods' => [
            ['id' => 1, 'name' => 'Boleto Bancario'],
            ['id' => 2, 'name' => 'Cartão de credito'],
            ['id' => 3, 'name' => 'Transferência Bancaria'],
            ['id' => 4, 'name' => 'Dinheiro']
         ],
         'status' => [
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

   public function store(PurchaseRequest $request)
   {
      DB::beginTransaction();

      $purchase = $request->only(['status', 'payment_method', 'note', 'purchase_date', 'quota', 'payout_interval']);
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

         $data['sub_total'] = $this->convertNumber($products['price'][$key]);
         $data['amount'] = intval($products['amount'][$key]);
         $data['profit'] = intval($products['profit'][$key]);

         array_push($itens, $data);
      }

      $purchase_product = PurchaseProduct::insert($itens);

      $lot['company_id'] = Auth::user()->company_id;
      $lot['purchase_id'] = $purchase_id->id;
      $lot['lot_number'] = lot_number($purchase_id->id, $purchase_id->created_at);
      $lot['purchase_date'] = $request->purchase_date;

      $lot_id = Lot::create($lot);

      $lot_itens = [];
      foreach ($itens as $item) {
         $item_data['company_id'] = Auth::user()->company_id;
         $item_data['lot_id'] = $lot_id->id;
         $item_data['product_id'] = $item['product_id'];
         $item_data['price'] = $this->price($item['sub_total'], $item['amount'], $item['profit']);
         $item_data['amount'] = $item['amount'];

         array_push($lot_itens, $item_data);
      }

      $lot_itens_id = LotItem::insert($lot_itens);


      $total = array_sum($products['price']);

      if ($request->payment_method == 1 || $request->payment_method == 2) {
         $quotas = [];
         $payout_interval = 0;
         for ($i = 0; $i < $request->quota; $i++) {
            $quota['company_id'] = Auth::user()->company_id;
            $quota['purchase_id'] = $purchase_id->id;
            $quota['quota'] = $i + 1;
            $quota['payment_status'] = $request->status;

            if ($request->payment_method == 1 && $i == 0) {
               $quota['due_date'] = date('Y-m-d', strtotime($request->due_date));
            } else {
               $payout_interval += $request->payout_interval;
               $quota['due_date'] = date('Y-m-d', strtotime("+$payout_interval days", strtotime($request->due_date)));
            }

            if ($request->payment_method == 2) {
               $quota['due_date'] = date('Y-m-d', strtotime("+$i month", strtotime($request->due_date)));
            }

            array_push($quotas, $quota);
         }

         $quota_id = Quota::insert($quotas);
      }

      if ($purchase_id && $purchase_product && $lot_id && $lot_itens_id) {
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
      $quotas = Quota::where('purchase_id', $purchase->id)->orderBy('id')->get();

      return view('admin.purchases.show', [
         'purchase' => $purchase,
         'quotas' => $quotas
      ]);
   }

   public function updateQuota(Request $request)
   {
      $quota = Quota::where('id', $request->id)->first();

      $quota->payment_status = $request->payment_status;

      if ($quota->save()) {
         $quotas = Quota::where([
            ['purchase_id', $quota->purchase_id],
            ['company_id', Auth::user()->company_id]
         ])->whereIn('payment_status', [2, 3])->get();

         if (count($quotas) == 0) {
            $purchase = Purchase::where('id', $quota->purchase_id)->first();
            $purchase->status = 1;
            $purchase->save();
         }
         return back()->withToastSuccess('Parcela faturada com sucesso!');
      }

      return back()->withToastError('Error ao faturar parcela!');
   }

   private function price(float $sub_total, int $amount, int $profit): float
   {
      $unit_price = $sub_total / $amount;
      $lucre = $unit_price * ($profit / 100);
      $price = $unit_price + $lucre;

      return number_format($price, 2);
   }

   private function convertNumber(string $value): float
   {
      return floatval(str_replace(',', '.', str_replace('.', '', $value)));
   }
}
