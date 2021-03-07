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
                  <li>
                     <a href="{{ route('users.index') }}">
                        <span class="sidebar-mini-icon">U</span>
                        <span class="sidebar-normal"> Usuários </span>
                     </a>
                  </li>
               </ul>
            </div>
         </li>

         <li class="{{ Route::is('clients.index') ? 'active' : '' }}">
            <a href="{{ route('clients.index') }}">
               <i class="nc-icon nc-single-02"></i>
               <p>Clientes</p>
            </a>
         </li>


         @can('Super Usuario')
            <li>
               <a data-toggle="collapse" href="#pagesExamples">
                  <i class="nc-icon nc-book-bookmark"></i>
                  <p>
                     Pages <b class="caret"></b>
                  </p>
               </a>
               <div class="collapse " id="pagesExamples">
                  <ul class="nav">
                     <li>
                        <a href="{{ route('profile') }}">
                           <span class="sidebar-mini-icon">UP</span>
                           <span class="sidebar-normal"> User Profile </span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
         @endcan
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
         @can('Super Usuario')
            <li>
               <a data-toggle="collapse" href="#tablesExamples">
                  <i class="nc-icon nc-single-copy-04"></i>
                  <p>
                     Tables <b class="caret"></b>
                  </p>
               </a>
               <div class="collapse " id="tablesExamples">
                  <ul class="nav">
                     <li>
                        <a href="{{ route('regular') }}">
                           <span class="sidebar-mini-icon">RT</span>
                           <span class="sidebar-normal"> Regular Tables </span>
                        </a>
                     </li>
                     <li>
                        <a href="{{ route('extended') }}">
                           <span class="sidebar-mini-icon">ET</span>
                           <span class="sidebar-normal"> Extended Tables </span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
         @endcan
      </ul>
   </div>
</div>
