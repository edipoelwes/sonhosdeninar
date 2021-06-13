@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title">
                        @can('Fototica Macedo')
                           <i class="bi bi-emoji-sunglasses" style="font-size: 2rem;"></i>
                        @elsecan('Sonhos de Ninar')
                        <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                        @endcan
                        {{ $category }}
                     </h4>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead class="text-primary">
                        <tr>
                           <th>N° Lote</th>
                           <th>Nome</th>
                           <th class="text-left">Preço</th>
                           <th class="text-center">Qtd.</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($products as $product)
                           <tr>
                              <td class="text-secondary">{{ $product->lot_number }}</td>
                              <td>
                                 <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column">
                                       <h6 class="mb-1 text-sm">
                                          @can('Fototica Macedo')
                                          {{ ucwords($product->brand).'  / REF N° '.mb_strtoupper($product->reference) }}
                                          @elsecan('Sonhos de Ninar')
                                          {{ ucwords($product->brand).'  '.mb_strtoupper($product->size) }}
                                          @endcan
                                       </h6>
                                       <p class="text-secondary mb-0">{{ $product->name }}</p>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-secondary text-left">R$ {{ money_br($product->price) }}</td>
                              <td class="text-center">
                                 <span class="h6 {{ $product->amount < 5 ? 'text-danger' : 'text-success' }}">
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
