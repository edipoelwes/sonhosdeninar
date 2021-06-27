<div class="modal fade user-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
   id="user-modal">
   <div class="modal-dialog modal-lg" role="document">
      <form action="{{ route('users.store') }}" method="POST" name="user-modal-form" autocomplete="off">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
               <p class="text-danger">Itens com * são obrigatórios</p>
               <input type="hidden" name="user_id" value="">
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="name">Nome *</label>
                     <input type="text" class="form-control" id="name" name="name" placeholder="Nome do usuário">
                     <div id="name-message" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="email">E-mail *</label>
                     <input type="email" class="form-control" id="email" name="email" placeholder="E-mail do usuário">
                     <div id="email-message" class="invalid-feedback"></div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <label for="phone">Telefone</label>
                     <input type="text" class="form-control phone_with_ddd" id="phone" name="phone" placeholder="Telefone">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="cpf">CPF *</label>
                     <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="CPF">
                     <div id="cpf-message" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-md-4">
                     <label for="password">Senha *</label>
                     <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                     <div id="password-message" class="invalid-feedback"></div>
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
         let email = $('#email')
         let cpf = $('#cpf')
         let password = $('#password')

         if(name.val() == '') {
            error = true
            name.addClass('is-invalid')
            $('#name-message').text(message)
         } else {
            error = false
            name.removeClass('is-invalid')
            $('#name-message').text('')
         }

         if(email.val() == '') {
            error = true
            email.addClass('is-invalid')
            $('#email-message').text(message)
         } else {
            let error = false
            email.removeClass('is-invalid')
            $('#email-message').text('')
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

         if(password.val() == '') {
            error = true
            password.addClass('is-invalid')
            $('#password-message').text(message)
         } else {
            let error = false
            password.removeClass('is-invalid')
            $('#password-message').text('')
         }

         if (error == false) {
            $('button#submit').attr('type', 'submit')
         }
      })
   </script>
@endpush
