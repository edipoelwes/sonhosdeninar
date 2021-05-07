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

      #amount {
         width: 40%;
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
                     <h4 class="card-title"><i class="bi bi-cart-check-fill" style="font-size: 2rem;"></i>Lançar Venda
                     </h4>
                  </div>
                  <div class="col-md-6">
                     <a href="{{ route('sales.index') }}" class="text-decoration-none float-right">
                        <i class="bi bi-arrow-left" style="font-size: 1rem; margin-right: 0.2rem;"></i>
                        Voltar a lista de vendas
                     </a>
                  </div>
               </div>
            </div>
            <hr>
            <div class="card-body">
               <form action="{{ route('sales.store') }}" method="POST" autocomplete="off">
                  @csrf
                  <div class="row">
                     <div class="col-md-5">
                        <div class="form-group">
                           <label for="sale_date">Cliente</label>
                           <select class="form-control">
                              <option value="">Selecione um Cliente</option>
                              @foreach ($clients as $client)
                                 <option value="{{ $client->id }}">{{ $client->name . '   ' . $client->cpf }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="col-md-4">
                        @include('admin.includes.payment_method', ['payment_methods' => $payment_methods])
                     </div>


                     <div class="col-md-3" id="div-purchaseDate">
                        <div class="form-group">
                           <label for="sale_date">Data da venda</label>
                           <input type="date" class="form-control" id="sale_date" name="sale_date">
                        </div>
                     </div>

                     <div class="col-md-3" id="div-status">
                        @include('admin.includes.status', ['status' => $status])
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="discount">Desconto R$</label>
                           <input type="text" class="form-control money_br_discount" id="discount" name="discount"
                              placeholder="0,00" onkeyup="updateTotal()">
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="note">Observações</label>
                           <input type="text" class="form-control" id="note" name="note" maxlength="255">
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div class="row mt-4">
                     <div class="col-md-12">
                        <div class="form-group">
                           <select class="form-control select2" onchange="sales(this.value)">
                              <option value="">Selecione um Item</option>
                              @foreach ($products as $product)
                                 <option value="{{ $product->id }}">
                                    Lote n°
                                    {{ $product->lot->lot_number . ' - ' . $product->product->category . ' ' . $product->product->brand . ' ' . $product->product->name . '   R$ ' . money_br($product->price) }}
                                 </option>
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
                                    <th colspan="3" style="width: 35%">Item</th>
                                    <th class="text-center" style="width: 15%">Preço</th>
                                    <th class="text-center" nowrap>Estoque</th>
                                    <th class="text-center" style="width: 20%">Qtd</th>
                                    <th class="text-left" nowrap>SubTotal</th>
                                 </tr>
                              </thead>
                              <tbody id="itens"></tbody>
                              <tbody>
                                 <tr>
                                    <td colspan="5"></td>
                                    <th class="text-right">Total</th>
                                    <td class="total text-secondary">R$ 0,00</td>
                                    <td colspan="1" class="text-right">
                                       <button type="submit" rel="tooltip" class="btn btn-round " data-original-title=""
                                          title="Concluir Venda">
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
      $('.money_br_discount').mask('000,00', { reverse: true });
      const sales = id => {
         if (id) {
            $.get("{{ route('products.sales') }}", {
               id
            }, function(product) {
               let item = `
                     <tr>
                        <td colspan="3">
                           <input type="hidden" class="price_subtotal" id="price_subtotal" value="${product.price}" name="price_subtotal[${product.id}]">
                           <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column">
                                 <h6 class="mb-1 text-sm">${product.category+' '+product.size+' '+product.brand}</h6>
                                 <p class="text-secondary mb-0">${product.name}</p>
                              </div>
                           </div>
                        </td>
                        <td class="text-center text-secondary">
                           <input type="hidden" id="price" value="${product.price}" name="price[${product.id}]">
                           ${Number(product.price).toLocaleString('pt-br', {
                              style: 'currency',
                              currency: 'BRL'
                           })}
                        </td>
                        <td class="text-center text-secondary">
                           ${product.amount}
                        </td>
                        <td class="text-center">
                           <input type="number" min="1" max="${product.amount}" class="input amount" id="amount" name="amount[${product.id}]" value="1" onchange="updateForAmount(this)" required>
                        </td>

                        <td class="text-left subtotal text-secondary">
                           ${Number(product.price).toLocaleString('pt-br', {
                              style: 'currency',
                              currency: 'BRL'
                           })}
                        </td>
                        <td class="">
                           <a href="javascript:;" class="btn btn-danger" onclick="deleteProduct(this)">
                              <i class="nc-icon nc-simple-remove"></i>
                           </a>
                        </td>
                     </tr>`

               if ($(`input[name="amount[${product.id}]"]`).length == 0) {
                  $('table #itens').append(item)
                  updateTotal()
               }
            })
         }
      }

      const updateTotal = () => {
         let discount = $('#discount').val()
         if(discount == '') {
            discount = 0
         } else {
            discount = Number(discount.replace(',', '.'))
         }

         let total = 0
         for (let i = 0; i < $('.amount').length; i++) {
            let price = $('.price_subtotal').eq(i)
            total += Number(price.val())
         }

         total -= discount

         $('.total').html(total.toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
         }))
      }

      const updateForAmount = obj =>  {
         let amount = $(obj).val()
         let price = $(obj).closest('tr').find('#price').val()
         let subtotal = Number(price) * Number(amount)
         $(obj).closest('tr').find('#price_subtotal').val(subtotal)

         $(obj).closest('tr').find('.subtotal').html(subtotal.toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
         }))
         updateTotal();
      }

      const deleteProduct = obj => {
         $(obj).closest('tr').remove();
         updateTotal();
      }
   </script>
@endpush
