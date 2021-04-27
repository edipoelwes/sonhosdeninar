@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-{{ count($purchase->quotas) > 0 ? '6' : '12' }}">
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
                           <div class="col-md-8">
                              <label>Usuário responsável</label>
                              <input type="text" class="form-control" placeholder="{{ $purchase->user->name }}">
                           </div>

                           <div class="col-md-4">
                              <label>Data da Compra</label>
                              <input type="text" class="form-control" placeholder="{{ $purchase->purchase_date }}">
                           </div>
                           <div class="col-md-4">
                              <label>Forma de pagamento</label>
                              <input type="text" class="form-control" placeholder="{{ $purchase->payment_method }}">
                           </div>

                           <div class="col-md-4">
                              <label>Parcelas</label>
                              <input type="text" class="form-control"
                                 placeholder="{{ $purchase->quota . ' x de R$ ' . money_br($purchase->purchaseProducts->sum('sub_total') / $purchase->quota) }}">
                           </div>

                           <div class="col-md-4">
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
                           <div class="col-md-6">
                              <label>Cnpj</label>
                              <input type="text" class="form-control" placeholder="{{ $purchase->provider->cnpj }}">
                           </div>
                           <div class="col-md-6">
                              <label>Telefone</label>
                              <input type="text" class="form-control" placeholder="{{ $purchase->provider->phone }}">
                           </div>
                        </div>
                     </fieldset>
                  </div>
               </div>
            </div>
            @if (count($purchase->quotas) > 0)
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                           <div class="col-md-6">
                              <h4 class="card-title"><i class="bi bi-list-check" style="font-size: 2rem;"></i></h4>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <legend>Parcela / Vencimento</legend>
                        <div class="row">
                           <div class="col-md-4">
                              <label>Parcela / Vencimento</label>
                           </div>
                           <div class="col-md-4">
                              <label>Valor</label>
                           </div>
                        </div>
                        @foreach ($quotas as $quota)
                           <form action="{{ route('purchases.quota') }}" method="POST"
                              id="form_faturar_{{ $quota->id }}">
                              @csrf
                              <input type="hidden" name="id" value="{{ $quota->id }}">
                              <input type="hidden" name="payment_status" value="1">
                              <div class="row">
                                 <div class="col-md-4 mb-2">
                                    <input type="text" class="form-control"
                                       placeholder="{{ $quota->quota . '   ' . date_br($quota->due_date) }}" disabled>
                                 </div>

                                 <div class="col-md-4">
                                    <input type="text" class="form-control"
                                       placeholder="R$ {{ money_br($purchase->purchaseProducts->sum('sub_total') / $purchase->quota) }}"
                                       disabled>
                                 </div>
                                 <div class="col-md-4">
                                    <select class="form-control" name="faturamento_{{ $quota->id }}"
                                       id="faturamento_{{ $quota->id }}" onchange="faturar(this.value)"
                                       {{ $quota->payment_status == 1 ? 'disabled' : '' }}>
                                       <option
                                          value="{{ json_encode(['value' => 1, 'quota' => $quota->quota, 'id' => $quota->id, 'data_vencimento' => date_br($quota->due_date)]) }}"
                                          {{ $quota->payment_status == 1 ? 'selected' : '' }}>Faturado</option>
                                       <option
                                          value="2"
                                          {{ $quota->payment_status == 2 ? 'selected' : '' }}>Pendente</option>
                                    </select>
                                 </div>
                              </div>
                           </form>
                        @endforeach
                     </div>
                  </div>
               </div>
            @endif
         </div>

         <div class="card">
            <div class="card-body">
               <legend>Itens da compra</legend>
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead class="thead-dark">
                        <tr>
                           {{-- <th>categoria</th> --}}
                           <th>Produto</th>
                           {{-- <th class="text-center">Tamanho</th> --}}
                           <th class="text-center">Unid.</th>
                           <th class="text-center">Qtd.</th>
                           <th class="text-center" nowrap>Sub-total</>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($purchase->purchaseProducts as $item)
                           <tr>
                              <td>
                                 <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column">
                                       <h6 class="mb-1 text-sm">
                                          {{ substr(ucwords($item->product->category), 0, -1) . ' ' . ucwords($item->product->brand) . ' ' . strtoupper($item->product->size) ?? '' }}
                                       </h6>
                                       <p class="text-secondary mb-0">{{ $item->product->name }}</p>
                                    </div>
                                 </div>
                              </td>
                              {{-- <td>{{ mb_strtoupper($item->product->category) }}</td>
                              <td>{{ ucwords($item->product->brand).' '.$item->product->name }}</td>
                              <td class="text-center">{{  strtoupper($item->product->size) ?? '' }}</td> --}}
                              <td class="text-secondary text-center" nowrap>R$
                                 {{ money_br($item->sub_total / $item->amount) }}</td>
                              <td class="text-secondary text-center">{{ $item->amount }}</td>
                              <td class="text-secondary text-right">R$ {{ money_br($item->sub_total) }}</td>
                           </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr style="background: #ccc">
                           <td colspan="2"></td>
                           <td class="text-bold text-center"><strong>TOTAL</strong></td>
                           <td class="text-secondary text-right">R$
                              {{ money_br($purchase->purchaseProducts->sum('sub_total')) }}</td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>

         </div>
      </div>
   </div>
@endsection


@push('js')
   <script>
      const faturar = datas => {
         const {
            value,
            quota,
            id,
            data_vencimento
         } = JSON.parse(datas)

         if(value == 1) {
            confirmQuota(id, quota, data_vencimento)
         }

         return null

      }

      function confirmQuota(id, quota, data_vencimento) {
         Swal.fire({
            title: 'Atenção',
            text: `Faturar parcela n° ${quota} com vencimento para o dia ${data_vencimento}`,
            type: 'warning',
            //input: 'text',
            //inputPlaceholder: 'Informe o motivo',
            //position: 'top-end',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sim, faturar!',
            reverseButtons: true,
            preConfirm: () => {
               $(`#form_faturar_${id}`).submit()
            },
         }).then(() => {
            $(`#faturamento_${id} option[value="2"]`).prop('selected', true)
         })
      }

   </script>
@endpush
