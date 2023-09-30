<div class="form-group {{ $required == true ? 'required' : '' }}">
    <label for="{{ $id }}">{{ $label }}</label>

    <input type="file" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
           id="{{ $id }}" {{ isset($required) && $required == true ? 'required' : '' }}
           {{ isset($multiple) && $multiple == true ? 'multiple' : '' }} accept="*/*" />

    @error($name)
    <span class="invalid-feedback block d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
