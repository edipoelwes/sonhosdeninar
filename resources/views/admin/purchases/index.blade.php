@extends('layout.master')

@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-bag-check-fill" style="font-size: 2rem;"></i> Compras</h4>
                  </div>
                  <div class="col-md-6">
                     <a href="{{ route('purchases.create') }}" class="btn btn-success btn-round pull-right">
                        <i class="bi bi-bag-dash-fill" style="font-size: 1rem; margin-right: 0.2rem;"></i>
                        Registrar Compras
                     </a>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped dataTables">
                     <thead class="text-primary">
                        <tr>
                           <th>N° Lote</th>
                           <th>Nome</th>
                           <th>CPF</th>
                           <th class="text-center">Telefone</th>
                           <th class="text-center">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse ($purchases as $purchase)
                           <tr>
                              <td class="text-center">{{ $purchase->id }}/{{date('Ymd', strtotime($purchase->created_at))}}</td>
                              <td>{{ $purchase->name ??'' }}</td>
                              <td>{{ $purchase->cpf ?? '' }}</td>
                              <td class="text-center">{{ $purchase->phone ?? '' }}</td>
                              </td>
                              <td class="text-center">
                                 <a href="javascrip:;" type="button" rel="tooltip" class="btn btn-info btn-icon btn-sm ">
                                    <i class="fa fa-user"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm"
                                    data-toggle="modal" data-target=".user-modal-lg"
                                    onclick="clientModal({{ $purchase->id }})" title="Editar Cliente">
                                    <i class="fa fa-edit"></i>
                                 </a>
                                 <a href="javascript:;" type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm "
                                    onclick="confirmDelete({{ $purchase->id }})" title="Excluir cliente">
                                    <i class="fa fa-times"></i>
                                 </a>
                                 <form id="btn-delete-{{ $purchase->id }}"
                                    action="{{ route('purchases.destroy', ['purchase' => $purchase->id]) }}" method="POST"
                                    class="hidden">
                                    @method('DELETE')
                                    @csrf
                                 </form>
                              </td>
                           </tr>
                        @empty
                           <tr>
                              <td colspan="5" class="h3 text-danger text-center">Nenhum registro encontrado</td>
                           </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

