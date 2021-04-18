<div class="form-group">
   <label for="payment_method">Forma de Pagamento</label>
   <select class="form-control" id="payment_method" name="payment_method" onchange="bank_slip(this.value)">
      <option value="">Selecione um metodo de pagamento</option>
      <option value="1">Boleto Bancario</option>
      <option value="2">Cartão de credito</option>
      <option value="3">Transferência Bancaria</option>
      <option value="4">Dinheiro</option>
   </select>
</div>
