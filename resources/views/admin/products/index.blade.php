@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-people-fill" style="font-size: 2rem;"></i> {{ $category }}</h4>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped dataTables">
                     <thead class="text-primary">
                        <tr>
                           <th>N° Lote</th>
                           <th>Nome</th>
                           <th>Tamanho</th>
                           <th>Preço</th>
                           <th class="text-center">Qtd.</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($products as $product)
                           <tr>
                              <td>{{ $product->lot_number }}</td>
                              <td>{{ ucwords($product->brand).' '.$product->name }}</td>
                              <td>{{ mb_strtoupper($product->size) }}</td>
                              <td class="text-right">{{ money_br($product->price) }}</td>
                              <td class="text-center">
                                 <span class="badge {{ $product->amount < 5 ? 'badge-danger' : 'badge-success' }}">
                                    {{ $product->amount }}
                                 </span>
                              </td>
                           </tr>
                        @empty
                           <tr>
                              <td colspan="5" class="h3 text-danger text-center">Nenhum Produto encontrado nesta categoria</td>
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
