<select 
    class="form-select"
    name="{{$name}}"
    id="{{$id}}" 
    aria-label="{{$aria}}"
    multiple>
    
    {{$slot}}

</select>
<label for="{{$for ?? $id}}">{{$label}}</label>