@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-bag-check-fill" style="font-size: 2rem;"></i> Compras</h4>
                  </div>
                  <div class="col-md-6">
                     <a href="{{ route('purchases.create') }}" class="btn btn-success btn-round pull-right">
                        <i class="bi bi-bag-dash-fill" style="font-size: 1rem; margin-right: 0.2rem;"></i>
                        Registrar Compras
                     </a>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped dataTables" style="width: 100%">
                     <thead class="text-primary">
                        <tr>
                           <th>N° Lote</th>
                           <th>Fornecedor</th>
                           <th class="text-center">Data da compra</th>
                           <th>Status</th>
                           <th class="text-center">Total R$</>
                           <th hidden></th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($purchases as $purchase)
                           <tr>
                              <td class="text-center">
                                 {{ lot_number($purchase->id, $purchase->created_at) }}</td>
                              <td>{{ $purchase->provider->name }}</td>
                              <td class="text-center">{{ $purchase->purchase_date }}</td>
                              <td class="text-center">
                                 <span class="badge {{ $purchase->status == 'Faturado' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $purchase->status }}
                                 </span>
                              </td>
                              <td class="text-right">{{ money_br($purchase->purchaseProducts->sum('sub_total')) }}</td>
                              </td>
                              <td class="text-center">
                                 <a href="{{ route('purchases.show', ['purchase' => $purchase->id]) }}" type="button"
                                    rel="tooltip" class="btn btn-default btn-icon btn-sm" title="Detalhes da compra">
                                    <i class="bi bi-list-check"></i>
                                 </a>
                              </td>
                           </tr>
                        @empty
                           <tr>
                              <td colspan="5" class="h3 text-danger text-center">Nenhum registro encontrado</td>
                           </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
