<div class="modal fade user-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
   id="user-modal">
   <div class="modal-dialog modal-lg" role="document">
      <form action="{{ route('users.store') }}" method="POST" name="user-modal-form" autocomplete="off">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Cadastro de usuário</h5>
            </div>
            <div class="modal-body">
               {{-- Limitar o visao da empresa para desenvolvedor --}}
               {{-- <div class="row">
                  <div class="form-group col-md-12">
                     <label for="company">Empresa</label>
                     <select id="company" class="form-control" name="company_id">
                        <option selected value="">selecione uma empresa</option>
                     </select>
                  </div>
               </div> --}}
               {{-- ------------------------------------------------ --}}

               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="name">Nome *</label>
                     <input type="text" class="form-control" id="name" name="name" placeholder="Nome do usuário">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="email">E-mail *</label>
                     <input type="email" class="form-control" id="email" name="email" placeholder="E-mail do usuário">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-4">
                     <label for="phone">Telefone</label>
                     <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="document">CPF *</label>
                     <input type="text" class="form-control" id="document" name="document" placeholder="CPF">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="password">Password *</label>
                     <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
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
