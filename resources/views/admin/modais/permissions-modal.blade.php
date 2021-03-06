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
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary mr-5">Salvar</button>
            </div>
         </div>
      </form>
   </div>
</div>
