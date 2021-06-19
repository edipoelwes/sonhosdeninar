@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-md-6">
                           <h4 class="card-title"><i class="bi bi-list-check" style="font-size: 2rem;"></i></h4>
                        </div>
                        <div class="col-md-6">
                           <a href="{{ route('sales.index') }}" class="text-decoration-none float-right">
                              <i class="bi bi-arrow-left" style="font-size: 1rem; margin-right: 0.2rem;"></i>
                              Voltar a lista de vendas
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <legend>Dados da venda n° {{ sale_number($sale->id) }}</legend>
                     <div class="form-row  mb-3">
                        <div class="col-md-6">
                           <label>Usuário responsável</label>
                           <input type="text" class="form-control" placeholder="{{ $sale->user->name }}" disabled>
                        </div>
                        <div class="col-md-6">
                           <label>Cliente</label>
                           <input type="text" class="form-control"
                              placeholder="{{ $sale->client->name . '   cpf ' . $sale->client->cpf }}" disabled>
                        </div>

                        <div class="col-md-2">
                           <label>Data da Venda</label>
                           <input type="text" class="form-control" placeholder="{{ $sale->sale_date }}" disabled>
                        </div>
                        <div class="col-md-3">
                           <label>Forma de pagamento</label>
                           <input type="text" class="form-control" placeholder="{{ $sale->payment_method }}" disabled>
                        </div>

                        <div class="col-md-3">
                           <label>Status da compra</label>
                           <input type="text" class="form-control" placeholder="{{ $sale->status }}" disabled>
                        </div>

                        @if ($sale->status != 'Cancelado')
                        <div class="col-md-2">
                        <form action="{{ route('sales.update', ['sale' => $sale->id]) }}" method="post" name="status">
                           @csrf
                           @method('PUT')
                              <label>Faturar Venda</label>
                              <select class="form-control" name="status"
                                 onchange="faturarSale(this.value)">
                                 <option value="1" {{ $sale->status == 'Faturado' ? 'selected' : '' }}>Faturado</option>
                                 <option value="2" {{ $sale->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                 <option value="3" {{ $sale->status == 'Cancelado' ? 'selected' : '' }}>Cancelado
                                 </option>
                              </select>
                           </form>
                        </div>
                        @endif

                        @if ($sale->note)
                           <div class="col-md-12 mt-2">
                              <label>Observações das compras</label>
                              <textarea class="form-control" cols="30" rows="10" disabled>   {{ $sale->note }}</textarea>
                           </div>
                        @endif
                     </div>
                  </div>
               </div>

               <div class="card">
                  <div class="card-body">
                     <legend>Itens da venda</legend>
                     <div class="table-responsive">
                        <table class="table table-striped">
                           <thead class="thead-dark">
                              <tr>
                                 <th>Produto</th>
                                 <th class="text-center">Preço. unit</th>
                                 <th class="text-center">Qtd.</th>
                                 <th class="text-center" nowrap>Sub-total</>

                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($sale->sale_products as $item)
                                 <tr>
                                    <td>
                                       <div class="d-flex px-2 py-1">
                                          <div class="d-flex flex-column">
                                             <h6 class="mb-1 text-sm">
                                                {{ $item->lot_item->product->category . ' ' . $item->lot_item->product->brand . ' ' . $item->lot_item->product->size }}
                                             </h6>
                                             <p class="text-secondary mb-0">{{ $item->lot_item->product->name }}</p>
                                          </div>
                                       </div>
                                    </td>
                                    <td class="text-secondary text-center">R$ {{ money_br($item->lot_item->price) }}
                                    </td>
                                    <td class="text-secondary text-center">{{ $item->amount }}</td>

                                    <td class="text-secondary text-center" nowrap>R$
                                       {{ money_br($item->subtotal) }}</td>
                                 </tr>
                              @endforeach
                           </tbody>
                           <tfoot>
                              <tr style="background: #ccc">
                                 <td colspan="2"></td>
                                 <td class="text-bold text-right"><strong>Total</strong></td>
                                 <td class="text-secondary text-center">R$
                                    {{ money_br($sale->sale_products->sum('subtotal')) }}</td>
                              </tr>
                              <tr style="background: #ccc">
                                 <td colspan="2"></td>
                                 <td class="text-bold text-right"><strong>Desconto</strong></td>
                                 <td class="text-secondary text-center">R$
                                    {{ $sale->discount }}</td>
                              </tr>
                              <tr style="background: #ccc">
                                 <td colspan="2"></td>
                                 <td class="text-bold text-right"><strong>Total Geral</strong></td>
                                 <td class="text-secondary text-center">R$
                                    {{ money_br($sale->sale_products->sum('subtotal') - money_db($sale->discount)) }}
                                 </td>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>

   @can('Fototica Macedo')
      <div class="row">
         @foreach ($sale->recipes as $recipe)
            <div class="col-lg-6 col-md-6 col-sm-6">
               <div class="card card-stats">
                  <div class="card-body ">
                     <a href="{{ env('APP_URL') }}/storage/{{ $recipe->path }}" download="{{$recipe->path}}">
                        <img src="{{ env('APP_URL') }}/storage/{{ $recipe->path }}" alt="receita de oculos">
                     </a>
                  </div>
               </div>
            </div>
         @endforeach
      </div>
   @endcan
@endsection


@push('js')
   <script>
      const faturarSale = value => {
         let status = value == '1' ? 'Faturado' : value == '2' ? 'Pendente' : 'Cancelado'
         Swal.fire({
            title: 'Atenção',
            text: `Alterar o status da venda para ${status}`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sim, alterar!',
            reverseButtons: true,
            preConfirm: () => {
               $('form[name=status]').submit()
            },
         })
      }

   </script>
@endpush
