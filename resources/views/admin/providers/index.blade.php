@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-truck" style="font-size: 2rem;"></i> Fornecedores</h4>
                  </div>
                  <div class="col-md-6">
                     <button type="button" class="btn btn-success btn-round pull-right" data-toggle="modal"
                        data-target=".provider-modal-lg" onclick="providerModal()">
                        <i class="bi bi-truck" style="font-size: 1rem; margin-right: 0.2rem;"></i> fornecedor
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped dataTables" style="width: 100%">
                     <thead class="text-primary">
                        <tr>
                           <th>Nome</th>
                           <th class="text-center">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($providers as $provider)
                           <tr>
                              <td>
                                 <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column">
                                       <h6 class="mb-1 text-sm">{{ $provider->name }}</h6>
                                       <p class="text-secondary mb-1">CNPJ: {{ $provider->cnpj }}</p>
                                       <p class="text-secondary mb-0">Telefone: {{ $provider->phone }}</p>
                                    </div>
                                 </div>
                              </td>
                              </td>
                              <td class="text-center">
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm"
                                    data-toggle="modal" data-target=".provider-modal-lg"
                                    onclick="providerModal({{ $provider->id }})" title="Editar Fornecedor">
                                    <i class="fa fa-edit"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm "
                                    onclick="confirmDelete({{ $provider->id }})" title="Excluir Fornecedor">
                                    <i class="fa fa-times"></i>
                                 </a>
                                 <form id="btn-delete-{{ $provider->id }}"
                                    action="{{ route('providers.destroy', ['provider' => $provider->id]) }}" method="POST"
                                    class="hidden">
                                    @method('DELETE')
                                    @csrf
                                 </form>
                              </td>
                           </tr>
                        @empty
                           <tr>
                              <td colspan="5" class="h3 text-danger">Nenhum forncedor encontrado</td>
                           </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   @include('admin.modais.providers-modal')
@endsection

@push('js')
   <script type="text/javascript">
      const providerModal = id => {
         if (id) {
            $('div.modal-header h5').text('Atualizar dados do fornecedor')
            $('input[name="provider_id"]').val(id)

            $.get("{{ route('providers.edit') }}", {
               id
            }, function(response) {
               if (response) {
                  $('input[name="name"]').val(response.name)
                  $('input[name="phone"]').val(response.phone)
                  $('input[name="cnpj"]').val(response.cnpj)
               }
            })
         } else {
            $('div.modal-header h5').text('Cadastrar fornecedor')
            $('input[name="provider_id"]').val('')

            $('input[name="name"]').val('')
            $('input[name="phone"]').val('')
            $('input[name="cnpj"]').val('')

         }
         $('#provider-modal').modal('show')
      }

   </script>
@endpush
