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
                     <div id="name-message" class="invalid-feedback"></div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <label for="phone">Telefone *</label>
                     <input type="text" class="form-control phone_with_ddd" id="phone" name="phone" placeholder="Telefone">
                     <div id="phone-message" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-md-4">
                     <label for="phone_secundary">Telefone secundario</label>
                     <input type="text" class="form-control phone_with_ddd" id="phone_secundary" name="phone_secundary" placeholder="Telefone opcional">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="cnpj">CNPJ *</label>
                     <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" placeholder="CNPJ">
                     <div id="cnpj-message" class="invalid-feedback"></div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
               <button type="button" class="btn btn-primary mr-5" id="submit">Salvar</button>
            </div>
         </div>
      </form>
   </div>
</div>

@push('js')
   <script>
      $('#submit').click(function(){
         let message = "Campo obrigatório"
         let error = false

         let name = $('#name')
         let phone = $('#phone')
         let cnpj = $('#cnpj')

         if(name.val() == '') {
            error = true
            name.addClass('is-invalid')
            $('#name-message').text(message)
         } else {
            error = false
            name.removeClass('is-invalid')
            $('#name-message').text('')
         }

         if(phone.val() == '') {
            error = true
            phone.addClass('is-invalid')
            $('#phone-message').text(message)
         } else {
            let error = false
            phone.removeClass('is-invalid')
            $('#phone-message').text('')
         }

         if(cnpj.val() == '') {
            error = true
            cnpj.addClass('is-invalid')
            $('#cnpj-message').text(message)
         } else {
            let error = false
            cnpj.removeClass('is-invalid')
            $('#cnpj-message').text('')
         }

         if (error == false) {
            $('button#submit').attr('type', 'submit')
         }
      })
   </script>
@endpush
