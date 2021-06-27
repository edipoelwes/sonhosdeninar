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
                     <label for="phone_secondary">Telefone Secundario</label>
                     <input type="text" class="form-control phone_with_ddd" id="phone_secondary" name="phone_secondary" placeholder="Telefone Secundario">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="cpf">CPF *</label>
                     <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="CPF">
                     <div id="cpf-message" class="invalid-feedback"></div>
                  </div>
               </div>
               <hr>
               <h4 class="h6">Endereço</h4>
               <div class="row">
                  <div class="form-group col-md-4">
                     <label for="zipcode">CEP *</label>
                     <input type="text" class="form-control cep" id="zipcode" name="zipcode" placeholder="CEP">
                     <div id="zipecode-message" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-md-8">
                     <label for="street">Logradouro *</label>
                     <input type="text" class="form-control" id="street" name="street" placeholder="">
                     <div id="street-message" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-md-8">
                     <label for="complement">Complemento</label>
                     <input type="text" class="form-control" id="complement" name="complement" placeholder="">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="number">N° *</label>
                     <input type="text" class="form-control" id="number" name="number" placeholder="">
                     <div id="number-message" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-md-4">
                     <label for="neighborhood">Bairro</label>
                     <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="" readonly>
                     <div id="neighborhood-message" class="invalid-feedback"></div>
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
         let cpf = $('#cpf')
         let zipcode = $('#zipcode')
         let street = $('#street')
         let number = $('#number')
         let neighborhood = $('#neighborhood')

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

         if(cpf.val() == '') {
            error = true
            cpf.addClass('is-invalid')
            $('#cpf-message').text(message)
         } else {
            let error = false
            cpf.removeClass('is-invalid')
            $('#cpf-message').text('')
         }

         if(zipcode.val() == '') {
            error = true
            zipcode.addClass('is-invalid')
            $('#zipcode-message').text(message)
         } else {
            let error = false
            zipcode.removeClass('is-invalid')
            $('#zipcode-message').text('')
         }

         if(street.val() == '') {
            error = true
            street.addClass('is-invalid')
            $('#street-message').text(message)
         } else {
            let error = false
            street.removeClass('is-invalid')
            $('#street-message').text('')
         }

         if(zipcode.val() == '') {
            error = true
            number.addClass('is-invalid')
            $('#number-message').text(message)
         } else {
            let error = false
            number.removeClass('is-invalid')
            $('#number-message').text('')
         }

         if(zipcode.val() == '') {
            error = true
            neighborhood.addClass('is-invalid')
            $('#neighborhood-message').text(message)
         } else {
            let error = false
            neighborhood.removeClass('is-invalid')
            $('#neighborhood-message').text('')
         }

         if (error == false) {
            $('button#submit').attr('type', 'submit')
         }
      })
   </script>
@endpush
