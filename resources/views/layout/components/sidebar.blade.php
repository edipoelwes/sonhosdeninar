<div class="sidebar" data-color="primary" data-active-color="warning">
   <!-- Tip 1: You can change the color of the sidebar using: data-color=" default | primary | info | success | warning | danger |" -->

   <div class="sidebar-wrapper">
      <div class="user">
         <div class="photo">
            <img src="{{ asset('assets/img/logo-small.png') }}" />
         </div>
         <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
               <span>
                  Edipo Elwes
                  {{-- <b class="caret"></b> --}}
               </span>
            </a>
            {{-- <div class="clearfix"></div>
            <div class="collapse" id="collapseExample">
               <ul class="nav">
                  <li>
                     <a href="#">
                        <span class="sidebar-mini-icon">MP</span>
                        <span class="sidebar-normal">My Profile</span>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <span class="sidebar-mini-icon">EP</span>
                        <span class="sidebar-normal">Edit Profile</span>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <span class="sidebar-mini-icon">S</span>
                        <span class="sidebar-normal">Settings</span>
                     </a>
                  </li>
               </ul>
            </div> --}}
         </div>
      </div>
      <ul class="nav">
         <li class="{{ Route::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}">
               <i class="nc-icon nc-bank"></i>
               <p>Dashboard</p>
            </a>
         </li>

         <li class="{{ Route::is('roles.index') || Route::is('permissions.index')  ? 'active' : '' }}">
            <a data-toggle="collapse" href="#pagesRoles">
               <i class="nc-icon nc-settings-gear-65"></i>
               <p>
                  Configurações <b class="caret"></b>
               </p>
            </a>
            <div class="collapse " id="pagesRoles">
               <ul class="nav">
                  <li class="ml-3 {{ Route::is('products.inventory') ? 'active' : ''  }}">
                     <a href="{{ route('products.inventory') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-box-seam"></i>
                        </span>
                        <span class="sidebar-normal">Inventário</span>
                     </a>
                  </li>
                  <li class="ml-3 {{ Route::is('roles.index') ? 'active' : ''  }}">
                     <a href="{{ route('roles.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-person-fill"></i>
                        </span>
                        <span class="sidebar-normal">Perfis</span>
                     </a>
                  </li>
                  @can('Super Usuario')
                     <li class="ml-3 {{ Route::is('permissions.index') ? 'active' : ''  }}">
                        <a href="{{ route('permissions.index') }}">
                           <span class="sidebar-mini-icon">
                              <i class="bi bi-unlock-fill"></i>
                           </span>
                           <span class="sidebar-normal">Permissões</span>
                        </a>
                     </li>
                  @endcan
               </ul>
            </div>
         </li>

         <li class="{{ Route::is('users.index') || Route::is('clients.index') || Route::is('providers.index')  ? 'active' : '' }}">
            <a data-toggle="collapse" href="#pagesUsers">
               <i class="nc-icon nc-single-02"></i>
               <p>
                  Usuários <b class="caret"></b>
               </p>
            </a>
            <div class="collapse " id="pagesUsers">
               <ul class="nav">
                  <li class="ml-3 {{ Route::is('users.index') ? 'active' : '' }}">
                     <a href="{{ route('users.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="nc-icon nc-single-02"></i>
                        </span>
                        <span class="sidebar-normal"> Usuários </span>
                     </a>
                  </li>
                  <li class="ml-3 {{ Route::is('clients.index') ? 'active' : '' }}">
                     <a href="{{ route('clients.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-people"></i>
                        </span>
                        <span class="sidebar-normal">Clientes</span>
                     </a>
                  </li>

                  <li class="ml-3 {{ Route::is('providers.index') ? 'active' : '' }}">
                     <a href="{{ route('providers.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-truck"></i>
                        </span>
                        <span class="sidebar-normal">Fornecedores</span>
                     </a>
                  </li>
               </ul>
            </div>
         </li>

         <li class="{{ Route::is('products.index') ? 'active' : '' }}">
            <a data-toggle="collapse" href="#pagesProducts">
               <i class="bi bi-box-seam"></i>
               <p>
                  Produtos <b class="caret"></b>
               </p>
            </a>
            <div class="collapse " id="pagesProducts">
               <ul class="nav">
                  @can('Sonhos de Ninar')
                     <li class="ml-3">
                        <a href="{{ route('products.index', ['category' => 'fraldas']) }}">
                           <span class="sidebar-mini-icon">F</span>
                           <span class="sidebar-normal"> Fraldas </span>
                        </a>
                     </li>
                     <li class="ml-3">
                        <a href="{{ route('products.index', ['category' => 'lenços']) }}">
                           <span class="sidebar-mini-icon">L</span>
                           <span class="sidebar-normal"> Lenços </span>
                        </a>
                     </li>
                     <li class="ml-3">
                        <a href="{{ route('products.index', ['category' => 'roupas']) }}">
                           <span class="sidebar-mini-icon">R</span>
                           <span class="sidebar-normal"> Roupas </span>
                        </a>
                     </li>
                     <li class="ml-3">
                        <a href="{{ route('products.index', ['category' => 'calçados']) }}">
                           <span class="sidebar-mini-icon">C</span>
                           <span class="sidebar-normal"> Calçados </span>
                        </a>
                     </li>
                  @endcan
                  @can('Fototica Macedo')
                     <li class="ml-3">
                        <a href="{{ route('products.index', ['category' => 'armação receituario']) }}">
                           <span class="sidebar-mini-icon">
                              <i class="bi bi-eyeglasses"></i>
                           </span>
                           <span class="sidebar-normal"> Armação Receituario </span>
                        </a>
                     </li>
                     <li class="ml-3">
                        <a href="{{ route('products.index', ['category' => 'óculos solar']) }}">
                           <span class="sidebar-mini-icon">
                              <i class="bi bi-sunglasses"></i>
                           </span>
                           <span class="sidebar-normal"> Óculos Solar </span>
                        </a>
                     </li>
                  @endcan
               </ul>
            </div>
         </li>

         <li class="{{ Route::is('purchases.index') ? 'active' : '' }}">
            <a data-toggle="collapse" href="#pagesTransactions">
               <i class="bi bi-arrow-left-right"></i>
               <p>
                  Transações <b class="caret"></b>
               </p>
            </a>
            <div class="collapse " id="pagesTransactions">
               <ul class="nav">
                  <li class="ml-3 {{ Route::is('purchases.index') ? 'active' : '' }}">
                     <a href="{{ route('purchases.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-bag"></i>
                        </span>
                        <span class="sidebar-normal"> Compras </span>
                     </a>
                  </li>

                  <li class="ml-3 {{ Route::is('sales.index') ? 'active' : '' }}">
                     <a href="{{ route('sales.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-cart"></i>
                        </span>
                        <span class="sidebar-normal"> Vendas </span>
                     </a>
                  </li>
               </ul>
            </div>
         </li>

         @can('Super Usuario')
            <li>
               <a data-toggle="collapse" href="#componentsExamples">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                     Components <b class="caret"></b>
                  </p>
               </a>
               <div class="collapse " id="componentsExamples">
                  <ul class="nav">
                     <li>
                        <a href="{{ route('icons') }}">
                           <span class="sidebar-mini-icon">I</span>
                           <span class="sidebar-normal"> Icons </span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
         @endcan
      </ul>
   </div>
</div>
