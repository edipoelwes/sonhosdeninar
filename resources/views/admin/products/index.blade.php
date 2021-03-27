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
                  <div class="col-md-6">
                     <button type="button" class="btn btn-success btn-round pull-right" data-toggle="modal"
                        data-target=".product-modal-lg" onclick="productModal()">
                        <i class="bi bi-person-plus-fill" style="font-size: 1rem; margin-right: 0.2rem;"></i> Produto
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped dataTables">
                     <thead class="text-primary">
                        <tr>
                           <th>Nome</th>
                           <th>Preço</th>
                           <th class="text-center">Qtd.</th>
                           <th class="text-center">Qtd Min.</th>
                           <th class="text-center">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($products as $product)
                           <tr>
                              <td>{{ $product->name }}</td>
                              <td class="text-right">{{ $product->price }}</td>
                              <td class="text-center">{{ $product->amount }}</td>
                              <td class="text-center">{{ $product->min_amount }}</td>
                              </td>
                              <td class="text-center">
                                 <a href="javascrip:;" type="button" rel="tooltip" class="btn btn-info btn-icon btn-sm ">
                                    <i class="fa fa-user"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm"
                                    data-toggle="modal" data-target=".user-modal-lg"
                                    onclick="productModal({{ $product->id }})" title="Editar produto">
                                    <i class="fa fa-edit"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm "
                                    onclick="confirmDelete({{ $product->id }})" title="Excluir produto">
                                    <i class="fa fa-times"></i>
                                 </a>
                                 <form id="btn-delete-{{ $product->id }}"
                                    action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST"
                                    class="hidden">
                                    @method('DELETE')
                                    @csrf
                                 </form>
                              </td>
                           </tr>
                        @empty
                           <tr>
                              <td colspan="5" class="h3 text-danger">Nenhum Produto encontrado nesta categoria</td>
                           </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   @include('admin.modais.products-modal')
@endsection

@push('js')
   <script type="text/javascript">
      const productModal = id => {
         if (id) {
            $('div.modal-header h5').text('Atualizar produto')
            $('input[name="product_id"]').val(id)

            $.get("{{ route('products.edit') }}", {
               id
            }, function(response) {
               if (response) {
                  $('input[name="name"]').val(response.name)
                  $('input[name=category]').val('{{ $category }}')
                  $(`select[name=size] option[value="${response.size}"]`).attr('selected', true)
                  $(`select[name=brand] option[value="${response.brand}"]`).attr('selected', true)
                  $('input[name="price"]').val(response.price)
                  $('input[name="min_amount"]').val(response.min_amount)
               }
            })
         } else {
            $('div.modal-header h5').text('Cadastrar produto')
            $('input[name="product_id"]').val('')

            $('input[name="name"]').val('')
            $('input[name=category]').val('{{ $category }}')
            $('select[name=brand] option[value=""]').attr('selected', true)
            $('select[name=size] option[value=""]').attr('selected', true)
            $('input[name="price"]').val('')
            $('input[name="min_amount"]').val('1')
         }
         $('#product-modal').modal('show')
      }

   </script>
@endpush
D
