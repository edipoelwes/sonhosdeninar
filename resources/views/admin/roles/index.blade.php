@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12 mx-auto">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title">
                        <i class="bi bi-person-fill" style="font-size: 2rem;"></i> Perfil
                     </h4>
                  </div>
                  <div class="col-md-6">
                     <button type="button" class="btn btn-success btn-round pull-right" data-toggle="modal"
                        data-target=".user-modal-lg" onclick="roleModal()">
                        <i class="bi bi-person-fill" style="font-size: 1rem; margin-right: 0.2rem;"></i> Cadastrar
                        perfil
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <table class="table table-striped table-hover">
                  <thead class="text-primary thead-dark">
                     <th class="text-center">Perfil</th>
                     <th class="text-center">Ação</th>
                  </thead>
                  <tbody>
                     @forelse ($roles as $role)
                        <tr>
                           <td class="text-center">{{ $role->name }}</td>
                           <td class="text-center">
                              <a href="javascript:;" class="text-primary mr-2" title="Editar Perfil" onclick="roleModal({{ $role->id }})">
                                 <i class="bi bi-pencil-square" style="font-size: 0.9rem;"></i>
                              </a>

                              <a href="{{ route('roles.permission', ['role' => $role->id]) }}" class="text-secondary mr-2" title="Permissões">
                                 <i class="bi bi-key-fill" style="font-size: 0.9rem;"></i>
                              </a>

                              <a href="javascript:;" class="text-danger" onclick="confirmDelete({{ $role->id }})"
                                 title="Excluir Perfil">
                                 <i class="bi bi-trash-fill" style="font-size: 0.9rem;"></i>
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
                           <td colspan="4" class="h3 text-danger text-center">Nenhum perfil encontrado</td>
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
            $('div.modal-header h5').text('Cadastrar Perfil')
            $('input[name="role_id"]').val(id)

            $.get("{{ route('roles.edit') }}", {
               id
            }, function(response) {
               if (response) {
                  $('input[name="name"]').val(response.name)
               }
            })
         } else {
            $('div.modal-header h5').text('Cadastrar Perfil')
            $('input[name="role_id"]').val('')
            $('input[name="name"]').val('')
         }
         $('#role-modal').modal('show')
      }

   </script>
@endpush
