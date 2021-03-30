@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-list-check" style="font-size: 2rem;"></i></h4>
                  </div>
                  <div class="col-md-6">
                     <a href="{{ route('purchases.index') }}" class="text-decoration-none float-right">
                        <i class="bi bi-arrow-left" style="font-size: 1rem; margin-right: 0.2rem;"></i>
                        Voltar a lista de compras
                     </a>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <fieldset disabled>
                  <legend>Dados da compra lote n° {{ lot_number($purchase->id, $purchase->created_at) }}</legend>
                  <div class="form-row">
                     <div class="col-md-3">
                        <label>Usuário responsável</label>
                        <input type="text" class="form-control" placeholder="{{ $purchase->user->name }}">
                     </div>

                     <div class="col-md-2">
                        <label>Data da Compra</label>
                        <input type="text" class="form-control" placeholder="{{ $purchase->purchase_date }}">
                     </div>
                     <div class="col-md-2">
                        <label>Forma de pagamento</label>
                        <input type="text" class="form-control" placeholder="{{ $purchase->payment_method }}">
                     </div>
                     <div class="col-md-3">
                        <label>Parcelas</label>
                        <input type="text" class="form-control"
                           placeholder="{{ $purchase->quota }} x de R$ {{ money_br($purchase->purchaseProducts->sum('sub_total') / $purchase->quota) }}">
                     </div>
                     <div class="col-md-2">
                        <label>Status da compra</label>
                        <input type="text" class="form-control" placeholder="{{ $purchase->status }}">
                     </div>
                     @if ($purchase->note)
                        <div class="col-md-12 mt-2">
                           <label>Status da compra</label>
                           <textarea class="form-control" cols="30" rows="10">  {{ $purchase->note }}</textarea>
                        </div>
                     @endif
                  </div>
                  <div class="form-row mt-3 mb-3">
                     <legend>Dados do fornecedor</legend>
                     <div class="col-md-6">
                        <label>Nome</label>
                        <input type="text" class="form-control" placeholder="{{ $purchase->provider->name }}">
                     </div>
                     <div class="col-md-2">
                        <label>Cnpj</label>
                        <input type="text" class="form-control" placeholder="{{ $purchase->provider->cnpj }}">
                     </div>
                     <div class="col-md-4">
                        <label>Telefone</label>
                        <input type="text" class="form-control" placeholder="{{ $purchase->provider->phone }}">
                     </div>
                  </div>
               </fieldset>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <legend>Itens da compra</legend>
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead class="thead-dark">
                        <tr>
                           <th>categoria</th>
                           <th>Produto</th>
                           <th class="text-center">Tamanho</th>
                           <th class="text-center">Unid.</th>
                           <th class="text-center">Qtd.</th>
                           <th class="text-center" nowrap>Sub-total</>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($purchase->purchaseProducts as $item)
                           <tr>
                              <td>{{ mb_strtoupper($item->product->category) }}</td>
                              <td>{{ ucwords($item->product->brand).' '.$item->product->name }}</td>
                              <td class="text-center">{{  strtoupper($item->product->size) ?? '' }}</td>
                              <td class="text-center" nowrap>R$ {{ money_br($item->sub_total / $item->amount)}}</td>
                              <td class="text-center">{{ $item->amount }}</td>
                              <td class="text-right">R$ {{money_br($item->sub_total) }}</td>
                           </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr style="background: #ccc">
                           <td colspan="4"></td>
                           <td class="text-bold text-center"><strong>TOTAL</strong></td>
                           <td class="text-right">R$ {{ money_br($purchase->purchaseProducts->sum('sub_total')) }}</td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>

         </div>
      </div>
   </div>
@endsection
