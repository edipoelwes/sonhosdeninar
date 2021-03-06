<div class="modal fade role-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
   id="role-modal">
   <div class="modal-dialog modal-md" role="document">
      <form action="{{ route('roles.store') }}" method="POST" name="role-modal-form" autocomplete="off">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
               <input type="hidden" name="role_id" value="">
               <div class="form-group">
                  <label for="name">Nome *</label>
                  <input type="text" class="form-control" id="name" name="name"
                     placeholder="Nome da perfil">
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
