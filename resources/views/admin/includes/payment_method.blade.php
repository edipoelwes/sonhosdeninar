<div class="form-group">
   <label for="payment_method">Forma de Pagamento</label>
   <select class="form-control" id="payment_method" name="payment_method" onchange="bank_slip(this.value)">
      <option value="">Metodo de pagamento</option>
      @foreach ($payment_methods as $method)
         <option value="{{ $method['id'] }}">{{ $method['name'] }}</option>
      @endforeach
   </select>
</div>
