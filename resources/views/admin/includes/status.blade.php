<div class="form-group">
   <label for="status">Status</label>
   <select class="form-control" id="status" name="status">
      <option>Status da venda</option>
      @foreach ($status as $st)
         <option value="{{ $st['id'] }}">{{ $st['name'] }}</option>
      @endforeach
   </select>
</div>
