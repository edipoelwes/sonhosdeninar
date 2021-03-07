<div class="modal fade client-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
   id="client-modal">
   <div class="modal-dialog modal-lg" role="document">
      <form action="{{ route('clients.store') }}" method="POST" name="client-modal-form" autocomplete="off">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
               <p class="text-danger">Itens com * são obrigatórios</p>
               <input type="hidden" name="client_id" value="">
               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="name">Nome *</label>
                     <input type="text" class="form-control" id="name" name="name" placeholder="Nome do usuário">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="phone">Telefone *</label>
                     <input type="text" class="form-control phone_with_ddd" id="phone" name="phone" placeholder="Telefone">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="document">CPF *</label>
                     <input type="text" class="form-control cpf" id="document" name="document" placeholder="CPF">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
               <button type="submit" class="btn btn-primary mr-5">Salvar</button>
            </div>
         </div>
      </form>
   </div>
</div>
