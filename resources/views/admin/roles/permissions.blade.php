@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12 mx-auto">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title">
                        <i class="bi bi-person-fill" style="font-size: 2rem;"></i> Permissões para {{ $role->name }}
                     </h4>
                  </div>
               </div>
            </div>
            <hr>
            <div class="card-body">
               <form action="{{ route('roles.permissionSync', ['role' => $role->id]) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row" style="width: 90%; margin: auto">
                     @foreach ($permissions as $permission)
                        <div class="form-check col-md-3">
                           <label class="form-check-label font-weight-bold text-uppercase">
                              <input class="form-check-input" type="checkbox" name="{{ $permission->id}}" id="{{ $permission->id}}" {{ $permission->can == '1' ? 'checked' : '' }}>
                              {{ $permission->name }}
                              <span class="form-check-sign">
                                 <span class="check"></span>
                              </span>
                           </label>
                        </div>
                     @endforeach
                  </div>
                  <input type="submit" class="btn btn-primary btn-round mt-3" value="Sincronizar Perfil">
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection
