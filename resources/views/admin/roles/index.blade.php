@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12 mx-auto">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title">
                        <i class="nc-icon nc-key-25" style="font-size: 2rem;"></i> Permissões
                     </h4>
                  </div>
                  <div class="col-md-6">
                     <button type="button" class="btn btn-success pull-right" data-toggle="modal"
                        data-target=".user-modal-lg" onclick="roleModal()">
                        <i class="nc-icon nc-key-25" style="font-size: 1rem; margin-right: 0.2rem;"></i> Cadastrar
                        permissão
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <table class="table table-striped">
                  <thead class="text-primary">
                     <th>Nome da permissão</th>
                     <th>Ação</th>
                  </thead>
                  <tbody>
                     @forelse ($roles as $role)
                        <tr>
                           <td>{{ $role->name }}</td>
                           <td>
                              <a href="javascript:;" class="text-primary mr-2" title="Editar Perfil" onclick="roleModal({{ $role->id }})">
                                 <i class="bi bi-pencil-square" style="font-size: 1.1rem;"></i>
                              </a>

                              <a href="javascript:;" class="text-secondary mr-2" title="Permissões">
                                 <i class="bi bi-key-fill" style="font-size: 1.1rem;"></i>
                              </a>

                              <a href="javascript:;" class="text-danger" onclick="confirmDelete({{ $role->id }})"
                                 title="Excluir Perfil">
                                 <i class="bi bi-trash-fill" style="font-size: 1.1rem;"></i>
                              </a>

                              <form id="btn-delete-{{ $role->id }}"
                                 action="{{ route('roles.destroy', ['role' => $role->id]) }}" method="post" class="hidden">
                                 @method('DELETE')
                                 @csrf
                              </form>
                           </td>
                        </tr>
                     @empty
                        <tr>
                           <td colspan="4" class="h3 text-danger text-center">Nenhuma permissão encontrada</td>
                        </tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   @include('admin.modais.roles-modal')
@endsection

@push('js')
   <script>
      const roleModal = id => {
         if (id) {
            $('div.modal-header h5').text('Cadastrar Permissão')
            $('input[name="role_id"]').val(id)

            $.get("{{ route('roles.edit') }}", {
               id
            }, function(response) {
               if (response) {
                  $('input[name="name"]').val(response.name)
               }
            })
         } else {
            $('div.modal-header h5').text('Cadastrar Permissão')
            $('input[name="role_id"]').val('')
            $('input[name="name"]').val('')
         }
         $('#role-modal').modal('show')
      }

   </script>
@endpush
