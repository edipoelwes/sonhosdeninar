<div class="form-group">
   <label for="status">Status</label>
   <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
      <option value="">Status da venda</option>
      @foreach ($status as $st)
         <option value="{{ $st['id'] }}" @if ($st['id'] == old('status')) selected @endif>{{ $st['name'] }}</option>
      @endforeach
   </select>

   @error('status')
      <div id="" class="invalid-feedback">
         {{ $message }}
      </div>
   @enderror
</div>
