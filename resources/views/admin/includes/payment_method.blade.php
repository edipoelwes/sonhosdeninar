<div class="form-group">
   <label for="payment_method">Forma de Pagamento</label>
   <select class="form-control @error('payment_method') is-invalid @enderror"
      id="payment_method" name="payment_method" onchange="bank_slip(this.value)">
      <option value="">Metodo de pagamento</option>
      @foreach ($payment_methods as $method)
         <option value="{{ $method['id'] }}" @if ($method['id'] == old('payment_method')) selected @endif>{{ $method['name'] }}</option>
      @endforeach
   </select>

   @error('payment_method')
      <div id="" class="invalid-feedback">
         {{ $message }}
      </div>
   @enderror
</div>
