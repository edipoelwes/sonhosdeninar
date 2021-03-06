@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-people-fill" style="font-size: 2rem;"></i> Clientes</h4>
                  </div>
                  <div class="col-md-6">
                     <button type="button" class="btn btn-success btn-round pull-right" data-toggle="modal"
                        data-target=".user-modal-lg" onclick="clientModal()">
                        <i class="bi bi-person-plus-fill" style="font-size: 1rem; margin-right: 0.2rem;"></i> cliente
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead class="text-primary">
                        <tr>
                           <th class="text-center">#</th>
                           <th>Nome</th>
                           <th>CPF</th>
                           <th class="text-center">Telefone</th>
                           <th class="text-center">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($clients as $client)
                           <tr>
                              <td class="text-center">{{ $client->id }}</td>
                              <td>{{ $client->name }}</td>
                              <td>{{ $client->document }}</td>
                              <td class="text-center">{{ $client->phone }}</td>
                              </td>
                              <td class="text-center">
                                 <a href="javascrip:;" type="button" rel="tooltip"
                                    class="btn btn-info btn-icon btn-sm ">
                                    <i class="fa fa-user"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm"
                                    data-toggle="modal" data-target=".user-modal-lg" onclick="clientModal({{ $client->id }})"
                                    title="Editar Cliente">
                                    <i class="fa fa-edit"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm "
                                    onclick="confirmDelete({{ $client->id }})" title="Excluir cliente">
                                    <i class="fa fa-times"></i>
                                 </a>
                                 <form id="btn-delete-{{ $client->id }}"
                                    action="{{ route('clients.destroy', ['client' => $client->id]) }}" method="POST"
                                    class="hidden">
                                    @method('DELETE')
                                    @csrf
                                 </form>
                              </td>
                           </tr>
                        @empty
                           <tr>
                              <td colspan="5" class="h3 text-danger">Nenhum cliente encontrado</td>
                           </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   @include('admin.modais.clients-modal')
@endsection

@push('js')
   <script type="text/javascript">
      const clientModal = id => {
         if (id) {
            $('div.modal-header h5').text('Atualizar cliente')
            $('input[name="client_id"]').val(id)

            $.get("{{ route('clients.edit') }}", {
               id
            }, function(response) {
               if (response) {
                  $('input[name="name"]').val(response.name)
                  $('input[name="phone"]').val(response.phone)
                  $('input[name="document"]').val(response.document)
               }
            })
         } else {
            $('div.modal-header h5').text('Cadastrar cliente')
            $('input[name="client_id"]').val('')

            $('input[name="name"]').val('')
            $('input[name="phone"]').val('')
            $('input[name="document"]').val('')

         }
         $('#client-modal').modal('show')
      }

   </script>
@endpush
