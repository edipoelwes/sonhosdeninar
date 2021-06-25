<div class="form-group">
   <label for="quota">Parcelas</label>
   <select class="form-control" id="quota" name="quota">
      <option value="">Parcelas</option>
      @for ($i = 1; $i <= 12; $i++)
         <option value="{{ $i }}">{{ $i.'x' }}</option>
      @endfor
   </select>

   @error('quota')
      <div class="invalid-feedback">
         {{ $message }}
      </div>
   @enderror
</div>
