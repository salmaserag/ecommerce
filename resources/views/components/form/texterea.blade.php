<textarea 
     type="{{$type}}"
     class="{{$class ?? 'form-control'}}" 
     name="{{$name}}" 
     id="{{$id ?? $name}}" 
     placeholder="{{$placeholder ?? $label}}"
     >
     {{$value}}
</textarea>


<label class="text-muted" for="{{$for ?? $id}}">
    {{$label}}
</label>