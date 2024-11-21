<input type="{{$type ?? 'text'}}"
    name="{{$name}}" 
    value="{{$value}}"
    class="{{$class ?? 'form-control '}}"
    id="{{$id ?? $name}}"
    placeholder="{{$placeholder ?? $label}}"
>


<label class="text-muted" for="{{$for ?? $id}}">
    {{$label}}
</label>
