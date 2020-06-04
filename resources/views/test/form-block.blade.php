<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ $title }}</label>

   <div class="col-md-6">
        <input id="{{ $name }}" type="{{$type}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{ $name }}" value="{{ old($name) }}" >

        @if ($errors->has($name))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</div>
@isset($lang)
    @foreach(['ua', 'en'] as $k => $v)
<input type="hidden" name="languages[{{$k}}][language]" value="{{ $v }}">
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ $title }}<b class="text-success"> ({{ $v }})</b></label>

   <div class="col-md-6">
        <input id="languages{{$k}}{{ $name }}" type="text" class="form-control{{ $errors->has('languages.'.$k.'.'.$name) ? ' is-invalid' : '' }}" name="languages[{{ $k }}][{{ $name }}]" value="{{ old('languages.'.$k.'.'.$name) }}" >

        @if ($errors->has('languages.'.$k.'.'.$name))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('languages.'.$k.'.'.$name) }}</strong>
            </span>
        @endif
    </div>
</div>



    @endforeach
@endisset