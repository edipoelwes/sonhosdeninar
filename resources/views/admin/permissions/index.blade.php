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
                        data-target=".user-modal-lg" onclick="permissionModal()">
                        <i class="nc-icon nc-key-25" style="font-size: 1rem; margin-right: 0.2rem;"></i> Cadastrar
                        permissão
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <table class="table table-striped table-hover">
                  <thead class="text-primary thead-dark">
                     <tr>
                        <th>Nome</th>
                        <th>Ação</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse ($permissions as $permission)
                        <tr>
                           <td>{{ $permission->name }}</td>
                           <td>
                              <a href="javascript:;" class="text-primary mr-2" title="Editar Permissão"
                                 onclick="permissionModal({{ $permission->id }})">
                                 <i class="bi bi-pencil-square" style="font-size: 0.9rem;"></i>
                              </a>

                              <a href="javascript:;" class="text-danger" onclick="confirmDelete({{ $permission->id }})"
                                 title="Excluir Permissão">
                                 <i class="bi bi-trash-fill" style="font-size: 0.9rem;"></i>
                              </a>

                              <form id="btn-delete-{{ $permission->id }}"
                                 action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}"
                                 method="post" class="hidden">
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
   @include('admin.modais.permissions-modal')
@endsection

@push('js')
   <script>
      const permissionModal = id => {
         if (id) {
            $('div.modal-header h5').text('Cadastrar Permissão')
            $('input[name="permission_id"]').val(id)

            $.get("{{ route('permissions.edit') }}", {
               id
            }, function(response) {
               if (response) {
                  $('input[name="name"]').val(response.name)
               }
            })
         } else {
            $('div.modal-header h5').text('Cadastrar Permissão')
            $('input[name="permissions_id"]').val('')
            $('input[name="name"]').val('')
         }
         $('#permission-modal').modal('show')
      }

   </script>
@endpush
