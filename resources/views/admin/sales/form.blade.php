@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-cart-check-fill" style="font-size: 2rem;"></i>Lançar Venda
                     </h4>
                  </div>
                  <div class="col-md-6">
                     <a href="{{ route('sales.index') }}" class="text-decoration-none float-right">
                        <i class="bi bi-arrow-left" style="font-size: 1rem; margin-right: 0.2rem;"></i>
                        Voltar a lista de vendas
                     </a>
                  </div>
               </div>
            </div>
            <hr>
            <div class="card-body">
               <form action="{{ route('sales.store') }}" method="POST" autocomplete="off">
                  @csrf
                  <div class="row">
                     <div class="col-md-5">
                        <div class="form-group">
                           <label for="sale_date">Cliente</label>
                           <select class="form-control">
                              <option value="">Selecione um Cliente</option>
                              @foreach ($clients as $client)
                                 <option value="{{ $client->id }}">{{ $client->name.'   '.$client->cpf }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="col-md-4">
                        @include('admin.includes.payment_method', ['payment_methods' => $payment_methods])
                     </div>


                     <div class="col-md-3" id="div-purchaseDate">
                        <div class="form-group">
                           <label for="sale_date">Data da venda</label>
                           <input type="date" class="form-control" id="sale_date" name="sale_date">
                        </div>
                     </div>

                     <div class="col-md-3" id="div-status">
                        @include('admin.includes.status', ['status' => $status])
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="discount">Desconto R$</label>
                           <input type="text" class="form-control money_br" id="discount" name="discount" placeholder="0,00">
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="note">Observações</label>
                           <input type="text" class="form-control" id="note" name="note">
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div class="row mt-4">
                     <div class="col-md-12">
                        <div class="form-group">
                           <select class="form-control select2" onchange="sales(this.value)">
                              <option value="">Selecione um Item</option>
                              @foreach ($products as $product)
                                 <option value="{{ $product->id }}">
                                 Lote n° {{ $product->lot->lot_number.' - '.$product->product->category.' '.$product->product->brand.' '.$product->product->name.'   R$ '.money_br($product->price)}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive">
                           <table class="table table-striped">
                              <thead class="">
                                 <tr>
                                    <th colspan="3">Item</th>
                                    <th class="text-center">Preço</th>
                                    <th class="text-center">Qtd</th>
                                    <th class="text-left">% Lucro</th>
                                    <th class="text-left" nowrap>Preço Unit.</th>
                                 </tr>
                              </thead>
                              <tbody id="itens">

                              </tbody>
                              <tbody>
                                 <tr>
                                    <td colspan="5"></td>
                                    <th class="text-right">Total</th>
                                    <td class="total">R$ 0,00</td>
                                    <td colspan="1" class="text-right">
                                       <button type="submit" rel="tooltip" class="btn btn-round "
                                          data-original-title="" title="Concluir Venda">
                                          Salvar
                                       </button>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection

@push('js')
<script>
   const sales = id => {
      alert(id)
   }
</script>
@endpush
