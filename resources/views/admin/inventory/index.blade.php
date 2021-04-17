@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-box-seam" style="font-size: 2rem;"></i> Itens do Inventario</h4>
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
                           <th>Item</th>
                           <th class="text-center">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($inventories as $inventory)
                           <tr>
                              <td>
                                 <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column">
                                       <h6 class="mb-1 text-sm">{{ ucwords($inventory->category).' '.ucwords($inventory->brand).' Tam. '.mb_strtoupper($inventory->size) }}</h6>
                                       <p class="text-secondary mb-0">{{  $inventory->name }}</p>
                                    </div>
                                 </div>
                              </td>

                              </td>
                              <td class="text-center">
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm"
                                    data-toggle="modal" data-target=".user-modal-lg"
                                    onclick="productModal({{ $inventory->id }})" title="Editar produto">
                                    <i class="fa fa-edit"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm "
                                    onclick="confirmDelete({{ $inventory->id }})" title="Excluir produto">
                                    <i class="fa fa-times"></i>
                                 </a>
                                 <form id="btn-delete-{{ $inventory->id }}"
                                    action="{{ route('products.destroy', ['product' => $inventory->id]) }}" method="POST"
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
               console.log(response)
               if (response) {
                  $('input[name="name"]').val(response.name)
                  $(`select[name=category] option[value="${response.category}"]`).attr('selected', true)
                  $(`select[name=size] option[value="${response.size}"]`).attr('selected', true)
                  $(`select[name=brand] option[value="${response.brand}"]`).attr('selected', true)
               }
            })
         } else {
            $('div.modal-header h5').text('Cadastrar produto')
            $('input[name="product_id"]').val('')
            $('input[name="name"]').val('')
            $('select[name=category] option[value=""]').attr('selected', true)
            $('select[name=brand] option[value=""]').attr('selected', true)
            $('select[name=size] option[value=""]').attr('selected', true)
         }
         $('#product-modal').modal('show')
      }

   </script>
@endpush
