@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-cart-fill" style="font-size: 2rem;"></i> Vendas</h4>
                  </div>
                  <div class="col-md-6">
                     <a href="{{ route('sales.create') }}" class="btn btn-success btn-round pull-right">
                        <i class="bi bi bi-cart-fill" style="font-size: 1rem; margin-right: 0.2rem;"></i>
                        Registrar Vendas
                     </a>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped dataTables" style="width: 100%">
                     <thead class="text-primary">
                        <tr>
                           <th>Status</th>
                           <th class="text-center">Data da venda</th>
                           <th class="text-center">Total R$</th>
                           <th class="text-center">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($sales as $sale)
                           <tr>
                              <td class="text-center">
                                 <span class="badge {{ $sale->status == 'Faturado' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $sale->status }}
                                 </span>
                              </td>
                              <td class="text-center text-secondary">{{ $sale->sale_date }}</td>
                              <td class="text-right">R$ {{ money_br($sale->sale_products->sum('subtotal')) }}</td>
                              </td>
                              <td class="text-center">
                                 <a href="{{ route('sales.show', ['sale' => $sale->id]) }}" type="button"
                                    rel="tooltip" class="btn btn-default btn-icon btn-sm" title="Detalhes da Venda">
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
