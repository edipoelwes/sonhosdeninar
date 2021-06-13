<div class="modal fade product-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
   aria-hidden="true" id="product-modal">
   <div class="modal-dialog modal-lg" role="document">
      <form action="{{ route('products.store') }}" method="POST" name="product-modal-form" autocomplete="off">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
               <p class="text-danger">Itens com * são obrigatórios</p>
               <input type="hidden" name="product_id" value="">
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="category">Categoria *</label>
                     <select id="category" class="form-control" name="category">
                        <option value="">Selecione uma categoria</option>
                        @can('Sonhos de Ninar')
                           <option value="fraldas">Fraldas</option>
                           <option value="lenços">Lenços</option>
                           <option value="roupas">Roupas</option>
                           <option value="calçados">Calçados</option>
                           <option value="higiene">Higiene</option>
                           <option value="enxaval">Enxaval</option>
                        @endcan
                        @can('Fototica Macedo')
                           <option value="armação receituario">Armação receituario</option>
                           <option value="óculos solar">Óculos solar</option>
                        @endcan

                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="brand">Marca *</label>
                     <select id="brand" class="form-control" name="brand">
                        <option value="">Selecione uma marca</option>
                        @can('Sonhos de Ninar')
                           <option value="mamyPoko">MamyPoko</option>
                           <option value="huggies">Huggies</option>
                           <option value="pampers">Pampers</option>
                           <option value="pompom">pompom</option>
                           <option value="babysec">Babysec</option>
                           <option value="scoobydoo">Scoobydoo</option>
                        @endcan
                        @can('Fototica Macedo')
                           <option value="jean pierre">Jean Pierre</option>
                           <option value="urban">Urban</option>
                           <option value="lavorato">Lavorato</option>
                           <option value="fiamma">Fiamma</option>
                           <option value="ana hickmann">Ana Hickmann</option>
                           <option value="rayban ">Rayban </option>
                           <option value="scorpion">Scorpion</option>
                           <option value="monna occhiali">Monna Occhiali</option>
                           <option value="mr.Hit">Mr.Hit</option>
                           <option value="emid">Emid</option>
                        @endcan
                     </select>
                  </div>
               </div>
               <div class="row">
                  @can('Fototica Macedo')
                     <div class="form-group col-md-4">
                        <label for="reference">Referência *</label>
                        <input type="text" class="form-control refer" id="reference" name="reference" placeholder="Referência do produto">
                     </div>
                  @endcan

                  <div class="form-group col-md-8">
                     <label for="name">Nome @can('Sonhos de Ninar') * @endcan</label>
                     <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto">
                  </div>

                  @can('Sonhos de Ninar')
                     <div class="form-group col-md-4">
                        <label for="size">Tamanho</label>
                        <select id="size" class="form-control" name="size">
                           <option value="selected">Selecione um Tamanho</option>
                           <option value="rn">RN</option>
                           <option value="p">P</option>
                           <option value="m">M</option>
                           <option value="g">G</option>
                           <option value="xg">XG</option>
                           <option value="xxg">XXG</option>
                           <option value="grandinhos">GRANDINHOS</option>
                        </select>
                     </div>
                  @endcan
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
