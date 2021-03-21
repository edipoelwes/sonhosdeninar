@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-people-fill" style="font-size: 2rem;"></i> Usuários</h4>
                  </div>
                  <div class="col-md-6">
                     <button type="button" class="btn btn-success btn-round pull-right" data-toggle="modal"
                        data-target=".user-modal-lg" onclick="userModal()">
                        <i class="bi bi-person-plus-fill" style="font-size: 1rem; margin-right: 0.2rem;"></i> usuário
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead class="text-primary">
                        <tr>
                           <th>Name</th>
                           <th>CPF</th>
                           <th class="text-center">E-mail</th>
                           <th class="text-center">Telefone</th>
                           <th class="text-center">Logado em</th>
                           <th class="text-center">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($users as $user)
                           <tr>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->cpf }}</td>
                              <td class="text-center">{{ $user->email }}</td>
                              <td class="text-center">{{ $user->phone }}</td>
                              <td class="text-center">{{ $user->last_login_at ? date('d/m/y  H:i:s', strtotime($user->last_login_at)) : '------------' }}
                              </td>
                              <td class="text-center">
                                 <a href="{{ route('users.roles', ['user' => $user->id]) }}" type="button" rel="tooltip"
                                    class="btn btn-info btn-icon btn-sm ">
                                    <i class="fa fa-user"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm"
                                    data-toggle="modal" data-target=".user-modal-lg" onclick="userModal({{ $user->id }})"
                                    title="Editar Usuário">
                                    <i class="fa fa-edit"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm "
                                    onclick="confirmDelete({{ $user->id }})" title="Excluir usuario">
                                    <i class="fa fa-times"></i>
                                 </a>
                                 <form id="btn-delete-{{ $user->id }}"
                                    action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST"
                                    class="hidden">
                                    @method('DELETE')
                                    @csrf
                                 </form>
                              </td>
                           </tr>
                        @empty
                           <tr>
                              <td colspan="5" class="h3 text-danger">Nenhum usuário encontrado</td>
                           </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   @include('admin.modais.users-modal')
@endsection

@push('js')
   <script type="text/javascript">
      const userModal = id => {
         /*$.get("{{ route('companies') }}", function(response) {
            let options = [];
            response.forEach(company => {
               options.push(`<option value="${company.id}">${company.social_name}</option>`)
            })
            $('select#company').append(options)
         })*/

         if (id) {
            $('div.modal-header h5').text('Atualizar de usuário')
            $('input[name="user_id"]').val(id)

            $.get("{{ route('users.edit') }}", {
               id
            }, function(response) {
               if (response) {
                  $('input[name="name"]').val(response.name)
                  $('input[name="email"]').val(response.email)
                  $('input[name="phone"]').val(response.phone)
                  $('input[name="cpf"]').val(response.cpf)
               }
            })
         } else {
            $('div.modal-header h5').text('Cadastrar usuário')
            $('input[name="user_id"]').val('')

            $('input[name="name"]').val('')
            $('input[name="email"]').val('')
            $('input[name="phone"]').val('')
            $('input[name="cpf"]').val('')

         }
         $('#user-modal').modal('show')
      }

   </script>
@endpush
