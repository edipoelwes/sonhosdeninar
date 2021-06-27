<div class="modal fade permission-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
   id="permission-modal">
   <div class="modal-dialog modal-md" role="document">
      <form action="{{ route('permissions.store') }}" method="POST" name="permission-modal-form" autocomplete="off">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="permission_id" value="">
               <div class="form-group">
                  <label for="name">Nome *</label>
                  <input type="text" class="form-control" id="name" name="name"
                     placeholder="Nome da permissão">
                  <div id="name-message" class="invalid-feedback"></div>
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

         if(name.val() == '') {
            error = true
            name.addClass('is-invalid')
            $('#name-message').text(message)
         } else {
            let error = false
            name.removeClass('is-invalid')
            $('#name-message').text('')
         }

         if (error == false) {
            $('button#submit').attr('type', 'submit')
         }
      })
   </script>
@endpush
