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
                           <label for="client_id">Cliente</label>
                           <select class="form-control" name="client_id" id="client_id">
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
                           <input type="date" class="form-control" id="sale_date" name="sale_date" value="{{ date('Y-m-d') }}">
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
                  @can('Fototica Macedo')
                     <hr>
                     <div class="row">
                        <div class="col-md-6">
                           <span class="h4">Receitas</span>
                        </div>
                        <div class="col-md-6">
                           <button class="btn btn-secondary float-right" type="button" onclick="receitas()">Adicionar Receita</button>
                        </div>
                     </div>
                     <div class="receitas">

                     </div>
                  @endcan
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
      $('.money_br_discount').mask('000,00', {
         reverse: true
      });
      const sales = id => {
         if (id) {
            $.get("{{ route('products.sales') }}", {
               id
            }, function(product) {
               let size = product.size != null ? product.size : ''
               let name = product.name != null ? product.name : ''
               let item = `
                           <tr>
                              <td colspan="3">
                                 <input type="hidden" class="price_subtotal" id="price_subtotal" value="${product.price}" name="price_subtotal[${product.id}]">
                                 <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column">
                                       <h6 class="mb-1 text-sm">${product.category+' '+size+' '+product.brand}</h6>
                                       <p class="text-secondary mb-0">${name}</p>
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
         if (discount == '') {
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

         if (total < 0) {
            total = 0
         }

         $('.total').html(total.toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
         }))
      }

      const updateForAmount = obj => {
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

      const receitas = () => {
         let id = $('.receitas .row').length
         const div = `
            <div class="row mt-3">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="name">Nome</label>
                     <input type="text" class="form-control" name="name[${id}]">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="age">Idade</label>
                     <input type="text" class="form-control" name="age[${id}]">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="addition">Adição</label>
                     <input type="text" class="form-control" name="addition[${id}]">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="od">Longe</label>
                     <input type="text" class="form-control" name="od[${id}]" value="OD" readonly>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="esf_od">ESF</label>
                     <input type="text" class="form-control" name="esf_od[${id}]" value="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="cil_od">CIL</label>
                     <input type="text" class="form-control" name="cil_od[${id}]" value="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="eixo_od">EIXO</label>
                     <input type="text" class="form-control" name="eixo_od[${id}]" value="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="alt_od">ALT</label>
                     <input type="text" class="form-control" name="alt_od[${id}]" value="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="dnp_od">DNP</label>
                     <input type="text" class="form-control" name="dnp_od[${id}]" value="">
                  </div>
               </div>

               <div class="col-md-2">
                  <div class="form-group">
                     <label for="oe">Longe</label>
                     <input type="text" class="form-control" name="oe[${id}]" value="OE" readonly>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="esf_oe">ESF</label>
                     <input type="text" class="form-control" name="esf_oe[${id}]" value="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="cil_oe">CIL</label>
                     <input type="text" class="form-control" name="cil_oe[${id}]" value="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="eixo_oe">EIXO</label>
                     <input type="text" class="form-control" name="eixo_oe[${id}]" value="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="alt_oe">ALT</label>
                     <input type="text" class="form-control" name="alt_oe[${id}]" value="">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label for="dnp_oe">DNP</label>
                     <input type="text" class="form-control" name="dnp_oe[${id}]" value="">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="note_receita">Observações</label>
                     <input type="text" class="form-control" name="note_receita[${id}]" value="">
                  </div>
               </div>

               <div class="col-md-3">
                  <div class="form-group">
                     <label for="data_receita">Data da receita</label>
                     <input type="date" class="form-control" name="data_receita[${id}]">
                  </div>
               </div>

               <div class="col-md-3">
                  <div class="form-group">
                     <label for="doutor">Medico</label>
                     <input type="text" class="form-control" name="doutor[${id}]">
                  </div>
               </div>

               <div class="col-md-2">
                  <div class="form-check">
                     <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="monofocais[${id}]" onclick="verifica(this)" value="">
                        MONOFOCAIS
                        <span class="form-check-sign">
                           <span class="check"></span>
                        </span>
                     </label>
                  </div>
               </div>

               <div class="col-md-2">
                  <div class="form-check">
                     <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="multifocais[${id}]" onclick="verifica(this)" value="">
                        MULTIFOCAIS
                        <span class="form-check-sign">
                           <span class="check"></span>
                        </span>
                     </label>
                  </div>
               </div>

               <div class="col-md-2">
                  <div class="form-check">
                     <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="bifocais[${id}]" onclick="verifica(this)" value="">
                        BIFOCAIS
                        <span class="form-check-sign">
                           <span class="check"></span>
                        </span>
                     </label>
                  </div>
               </div>

               <div class="col-md-2">
                  <div class="form-check">
                     <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="reflexo[${id}]" onclick="verifica(this)" value="">
                        A.REFLEXO
                        <span class="form-check-sign">
                           <span class="check"></span>
                        </span>
                     </label>
                  </div>
               </div>

               <div class="col-md-2">
                  <div class="form-check">
                     <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="fotossensivel[${id}]" onclick="verifica(this)" value="">
                        FOTOSSENSIVEL
                        <span class="form-check-sign">
                           <span class="check"></span>
                        </span>
                     </label>
                  </div>
               </div>

               <div class="col-md-2">
                  <div class="form-check">
                     <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="monofocais[${id}]" onclick="verifica(this)" value="">
                        INCOLOR
                        <span class="form-check-sign">
                           <span class="check"></span>
                        </span>
                     </label>
                  </div>
               </div>
               <hr>
            </div>
         `
         $('.receitas').append(div)
      }

      const verifica = obj => {
         console.log(obj);
         if(obj.checked) {
            obj.value = 'T'
         } else {
            obj.value = 'F'
         }
      }

      const bank_slip = value => {
         $('#div-status select#status option').removeAttr('selected')
         switch (value) {
            case '1':
            case '2':
               $('#div-status select#status option[value="2"]').attr('selected','selected')
               break;
            case '3':
            case '4':
               $('#div-status select#status option[value="1"]').attr('selected','selected')
               break;
            default:
               $('#div-status select#status option[value=""]').attr('selected','selected')
         }
      }
   </script>
@endpush
