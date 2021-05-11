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
                  <table class="table table-striped dataTables" style="width: 100%">
                     <thead class="text-primary">
                        <tr>
                           <th>Cliente</th>
                           <th class="text-center">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($clients as $client)
                           <tr>
                              <td>
                                 <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column">
                                       <h6 class="mb-1 text-sm">{{ $client->name }}</h6>
                                       <p class="text-secondary mb-0">CPF: {{ $client->cpf }}</p>
                                       <p class="text-secondary mb-0">Telefone: {{ $client->phone }}</p>
                                    </div>
                                 </div>
                              </td>
                              </td>
                              <td class="text-center">
                                 <a href="javascrip:;" type="button" rel="tooltip" class="btn btn-info btn-icon btn-sm ">
                                    <i class="fa fa-user"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm"
                                    data-toggle="modal" data-target=".user-modal-lg"
                                    onclick="clientModal({{ $client->id }})" title="Editar Cliente">
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
               console.log(response);
               if (response) {
                  $('input[name="name"]').val(response.name)
                  $('input[name="phone"]').val(response.phone)
                  $('input[name="phone_secondary"]').val(response.phone_secondary)
                  $('input[name="cpf"]').val(response.cpf)

                  $("#zipcode").val(response.zipcode)
                  $("#street").val(response.street)
                  $("#complement").val(response.complement)
                  $("#number").val(response.number)
                  $("#neighborhood").val(response.neighborhood)
                  $("#city").val(response.city)
                  $("#state").val(response.state)
               }
            })
         } else {
            $('div.modal-header h5').text('Cadastrar cliente')
            $('input[name="client_id"]').val('')
            $('input[name="name"]').val('')
            $('input[name="phone"]').val('')
            $('input[name="phone_secondary"]').val('')
            $('input[name="cpf"]').val('')
            $("#zipcode").val('')
            $("#street").val('')
            $("#complement").val('')
            $("#number").val('')
            $("#neighborhood").val('')
            $("#city").val('')
            $("#state").val('')
         }
         $('#client-modal').modal('show')
      }

      const limpa_formulário_cep = () => {
         // Limpa valores do formulário de cep.
         $("#street").val("")
         $("#neighborhood").val("")
         $("#city").val("")
         $("#state").val("")
         $("#number").val("")
      }

      $('#zipcode').blur(function() {
         let cep = $(this).val().replace(/\D/g, '')
         if (cep != '') {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/

            //Valida o formato do CEP.
            if (validacep.test(cep)) {
               //Preenche os campos com "..." enquanto consulta webservice.
               $("#street").val("...")
               $("#complement").val("...")
               $("#neighborhood").val("...")
               $("#city").val("...")
               $("#state").val("...")


               //Consulta o webservice viacep.com.br/
               $.getJSON(`https://viacep.com.br/ws/${cep}/json/?callback=?`, function(response) {
                  if (response.bairro == '') {
                     $("#neighborhood").removeAttr('readonly').focus()
                  }
                  $("#street").val(response.logradouro)
                  $("#complement").val(response.complemento)
                  $("#neighborhood").val(response.bairro)
                  $("#city").val(response.localidade)
                  $("#state").val(response.uf)
               })
            } else {
               limpa_formulário_cep();
            }
         } else {
            limpa_formulário_cep();
         }
      })

   </script>
@endpush
