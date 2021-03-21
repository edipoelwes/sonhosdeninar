<div class="modal fade provider-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
   id="provider-modal">
   <div class="modal-dialog modal-lg" role="document">
      <form action="{{ route('providers.store') }}" method="POST" name="provider-modal-form" autocomplete="off">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
               <p class="text-danger">Itens com * são obrigatórios</p>
               <input type="hidden" name="provider_id" value="">
               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="name">Fornecedor *</label>
                     <input type="text" class="form-control" id="name" name="name" placeholder="Nome do fornecedor">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="phone">Telefone</label>
                     <input type="text" class="form-control phone_with_ddd" id="phone" name="phone" placeholder="Telefone">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="cnpj">CNPJ</label>
                     <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" placeholder="CNPJ">
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
