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
                     <label for="name">Nome Completo *</label>
                     <input type="text" class="form-control" id="name" name="name" placeholder="Nome do usuário">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <label for="phone">Telefone *</label>
                     <input type="text" class="form-control phone_with_ddd" id="phone" name="phone" placeholder="Telefone">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="phone_secondary">Telefone Secundario</label>
                     <input type="text" class="form-control phone_with_ddd" id="phone_secondary" name="phone_secondary" placeholder="Telefone Secundario">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="cpf">CPF *</label>
                     <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="CPF">
                  </div>
               </div>
               <hr>
               <h4 class="h6">Endereço</h4>
               <div class="row">
                  <div class="form-group col-md-4">
                     <label for="zipcode">CEP *</label>
                     <input type="text" class="form-control cep" id="zipcode" name="zipcode" placeholder="CEP">
                  </div>
                  <div class="form-group col-md-8">
                     <label for="street">Logradouro *</label>
                     <input type="text" class="form-control" id="street" name="street" placeholder="">
                  </div>
                  <div class="form-group col-md-8">
                     <label for="complement">Complemento</label>
                     <input type="text" class="form-control" id="complement" name="complement" placeholder="">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="number">N°</label>
                     <input type="text" class="form-control" id="number" name="number" placeholder="">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="neighborhood">Bairro</label>
                     <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="" readonly>
                  </div>
                  <div class="form-group col-md-4">
                     <label for="city">cidade</label>
                     <input type="text" class="form-control" id="city" name="city" placeholder="" readonly>
                  </div>
                  <div class="form-group col-md-4">
                     <label for="state">Estado</label>
                     <input type="text" class="form-control" id="state" name="state" placeholder="" readonly>
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
