<div class="sidebar" data-color="primary" data-active-color="success">
   <!-- Tip 1: You can change the color of the sidebar using: data-color=" default | primary | info | success | warning | danger |" -->
   <div class="logo">
      <a href="javascript:;" class="simple-text logo-mini">
         <div class="logo-image-small">
            <img src="{{ asset('assets/img/logo-small.png') }}">
         </div>

      </a>
      <a href="javascript:;" class="simple-text logo-normal">
         Sonhos de Ninar
      </a>
   </div>
   <div class="sidebar-wrapper">
      <div class="user">
         <div class="photo">
            <img src="{{ asset('assets/img/logo-small.png') }}" />
         </div>
         <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
               <span>
                  Edipo Elwes
                  <b class="caret"></b>
               </span>
            </a>
            <div class="clearfix"></div>
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
            </div>
         </div>
      </div>
      <ul class="nav">
         <li class="{{ Route::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}">
               <i class="nc-icon nc-bank"></i>
               <p>Dashboard</p>
            </a>
         </li>

         <li class="{{ Route::is('roles.index') ? 'active' : '' }}">
            <a data-toggle="collapse" href="#pagesRoles">
               <i class="nc-icon nc-settings-gear-65"></i>
               <p>
                  Configurações <b class="caret"></b>
               </p>
            </a>
            <div class="collapse " id="pagesRoles">
               <ul class="nav">
                  <li class="ml-3">
                     <a href="{{ route('roles.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-person-fill"></i>
                        </span>
                        <span class="sidebar-normal">Perfis</span>
                     </a>
                  </li>
                  <li class="ml-3">
                     <a href="{{ route('permissions.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-unlock-fill"></i>
                        </span>
                        <span class="sidebar-normal">Permissões</span>
                     </a>
                  </li>
               </ul>
            </div>
         </li>

         <li class="{{ Route::is('users.index') ? 'active' : '' }}">
            <a data-toggle="collapse" href="#pagesUsers">
               <i class="nc-icon nc-single-02"></i>
               <p>
                  Usuários <b class="caret"></b>
               </p>
            </a>
            <div class="collapse " id="pagesUsers">
               <ul class="nav">
                  <li class="ml-3">
                     <a href="{{ route('users.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="nc-icon nc-single-02"></i>
                        </span>
                        <span class="sidebar-normal"> Usuários </span>
                     </a>
                  </li>
                  <li class="ml-3">
                     <a href="{{ route('clients.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-people"></i>
                        </span>
                        <span class="sidebar-normal">Clientes</span>
                     </a>
                  </li>

                  <li class="ml-3">
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
                  <li class="ml-3">
                     <a href="{{ route('products.index', ['category' => 'fraldas']) }}">
                        <span class="sidebar-mini-icon">F</span>
                        <span class="sidebar-normal"> Fraldas </span>
                     </a>
                  </li>
                  <li class="ml-3">
                     <a href="{{ route('products.index', ['category' => 'lencos']) }}">
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
                  <li class="ml-3">
                     <a href="{{ route('purchases.index') }}">
                        <span class="sidebar-mini-icon">
                           <i class="bi bi-bag"></i>
                        </span>
                        <span class="sidebar-normal"> Compras </span>
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
