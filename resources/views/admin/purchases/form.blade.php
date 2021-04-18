@extends('layout.master')

@push('styles')
   <style>
      .input {
         height: 100%;
         border: none;
         outline: none;
         border-bottom: 1px solid #ccc;
         background: none;
         font-size: 1.2rem;
         color: #555;
         padding: 0.5rem 0.7rem;
      }

      #price {
         width: 55%;
      }

      #amount, #profit {
         width: 45%;
      }
   </style>
@endpush
@section('content')
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title"><i class="bi bi-bag-check-fill" style="font-size: 2rem;"></i>Lançar nova Compra
                     </h4>
                  </div>
                  <div class="col-md-6">
                     <a href="{{ route('purchases.index') }}" class="text-decoration-none float-right">
                        <i class="bi bi-arrow-left" style="font-size: 1rem; margin-right: 0.2rem;"></i>
                        Voltar a lista de compras
                     </a>
                  </div>
               </div>
            </div>
            <hr>
            <div class="card-body">
               <form action="{{ route('purchases.store') }}" method="POST" autocomplete="off">
                  @csrf
                  <div class="row">
                     <div class="col-md-4">
                        @include('admin.includes.payment_method')
                     </div>
                     <div class="col-md-2" id="div-quotas">
                        <div class="form-group">
                           <label for="quota">Parcelas</label>
                           <select class="form-control" id="quota" name="quota">
                              <option value="">Parcelas</option>
                              <option value="1">1x</option>
                              <option value="2">2x</option>
                              <option value="3">3x</option>
                              <option value="4">4x</option>
                              <option value="5">5x</option>
                              <option value="6">6x</option>
                              <option value="7">7x</option>
                              <option value="8">8x</option>
                              <option value="9">9x</option>
                              <option value="10">10x</option>
                              <option value="11">11x</option>
                              <option value="12">12x</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3" id="div-due">
                        <div class="form-group">
                           <label for="due_date">Data do vencimento</label>
                           <input type="date" class="form-control" id="due_date" name="due_date">
                        </div>
                     </div>
                     <div class="col-md-3" hidden id="div_payout_interval">
                        <div class="form-group">
                           <label for="payout_interval">Prazo de pagamento</label>
                           <select class="form-control" id="payout_interval" name="payout_interval">
                              <option value="">Intervalo</option>
                              <option value="10">cada 10 dias</option>
                              <option value="15">cada 15 dias</option>
                              <option value="20">cada 20 dias</option>
                              <option value="30">cada 30 dias</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3" id="div-purchaseDate">
                        <div class="form-group">
                           <label for="purchase_date">Data da Compra</label>
                           <input type="date" class="form-control" id="purchase_date" name="purchase_date">
                        </div>
                     </div>
                     <div class="col-md-6" id="div-provider_id">
                        <div class="form-group">
                           <label for="providers">Fornecedores</label>
                           <select class="form-control select2" id="providers" name="provider_id">
                              <option>Selecione um fornecedor</option>
                              @foreach ($providers as $provider)
                                 <option value="{{ $provider->id }}">{{ $provider->name }} - {{ $provider->cnpj }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6" id="div-status">
                        @include('admin.includes.status', ['status' => $status])
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="note">Observações</label>
                           <input type="text" class="form-control" id="note" name="note">
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div class="row mt-4">
                     <div class="col-md-12">
                        <div class="form-group">
                           <select class="form-control select2" onchange="purchases(this.value)">
                              <option value="">Selecione um Item</option>
                              @foreach ($products as $product)
                                 <option value="{{ $product->id }}">{{ $product->category }} {{ $product->brand }} {{ $product->name }} {{ $product->size }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive">
                           <table class="table table-striped">
                              <thead class="">
                                 <tr>
                                    <th colspan="3">
                                       Item
                                    </th>
                                    <th class="text-center">
                                       Preço
                                    </th>
                                    <th class="text-center">
                                       Qtd
                                    </th>
                                    <th class="text-left">
                                       % Lucro
                                    </th>
                                    <th class="text-left" nowrap>
                                       Preço Unit.
                                    </th>
                                 </tr>
                              </thead>
                              <tbody id="itens">

                              </tbody>
                              <tbody>
                                 <tr>
                                    <td colspan="5">
                                    </td>
                                    <th class="text-right">
                                       Total
                                    </th>
                                    <td class="total">
                                       R$ 0,00
                                    </td>
                                    <td colspan="1" class="text-right">
                                       <button type="submit" rel="tooltip" class="btn btn-round "
                                          data-original-title="" title="Concluir Compra">
                                          Salvar
                                       </button>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection

@push('js')
   <script>
      function bank_slip(value) {
         if(value == 1) {
            $('#div_payout_interval').removeAttr('hidden')
         } else {
            $('#div_payout_interval').attr('hidden', true)
         }
      }
      // function quotas(value) {
      //    if (value == 1 || value == 2) {
      //       $('#div-quotas').removeAttr('hidden')
      //       $('#div-due').removeAttr('hidden')
      //    } else {
      //       $('#div-quotas').attr('hidden', '')
      //       $('#div-due').attr('hidden', '')
      //    }
      // }

      function purchases(id) {
         $.get("{{ route('products.product') }}", {
            id
         }, function(product) {
            let item = `
               <tr>
                  <td colspan="3">
                     ${product.category} ${product.brand} ${product.name} ${product.size}
                  </td>
                  <td class="text-right">
                     R$ <input type="number" class="input price" id="price" name="price[${product.id}]" min="1" step="0.01" placeholder="0,00" onchange="updateForPrice(this)" required>
                  </td>
                  <td class="text-center">
                     <input type="number" min="1" class="input amount" id="amount" name="amount[${product.id}]" value="1" onchange="updateForAmount(this)" required>
                  </td>
                  <td class="text-left">
                     <input type="number" min="1" class="input" id="profit" name="profit[${product.id}]" placeholder="30" required>
                  </td>
                  <td class="text-left unit_price">
                     R$ 0,00
                  </td>
                  <td class="">
                     <a href="javascript:;" class="btn btn-danger" onclick="deleteProduct(this)">
                        <i class="nc-icon nc-simple-remove"></i>
                     </a>
                  </td>
               </tr>`

            if ($(`input[name="amount[${product.id}]"]`).length == 0) {
               $('table #itens').append(item)
            }
         })
      }

      function updateTotal() {
         let total = 0
         for(let i = 0; i < $('.amount').length; i++ ) {
            let price = $('.price').eq(i)
            total += parseFloat(price.val())
         }

         $('.total').html(total.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'}))
      }

      function updateForPrice (obj) {
         let price = $(obj).val()
         let amount = $(obj).closest('tr').find('#amount').val()
         let unitPrice = (parseFloat(price) / parseInt(amount)).toLocaleString('pt-br', {style: 'currency', currency: 'BRL'})

         $(obj).closest('tr').find('.unit_price').html(unitPrice)
         updateTotal();
      }

      function updateForAmount (obj) {
         let amount = $(obj).val()
         let price = $(obj).closest('tr').find('#price').val()

         if(!price) {
            price = 0
         }

         let unitPrice = (parseFloat(price) / parseInt(amount)).toLocaleString('pt-br', {style: 'currency', currency: 'BRL'})

         $(obj).closest('tr').find('.unit_price').html(unitPrice)
         updateTotal();
      }

      function deleteProduct(obj) {
         $(obj).closest('tr').remove();
         updateTotal();
      }

   </script>
@endpush
