<div class="form-group {{ $required == true ? 'required' : '' }}">
    @if ($type != 'hidden')
        <label for="{{ $id }}">{{ $label }}</label>
    @endif

    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
           id="{{ $id }}" {{ isset($required) && $required == true ? 'required' : '' }}
           step="{{ isset($step) ? $step : '' }}" autocomplete="off" placeholder="{{ __('common.' . $name) }}"
           @if (isset($disabled) && $disabled == true) disabled @endif @if (isset($readonly) && $readonly == true) readonly @endif
           @if (isset($min)) min="{{ $min }}" @endif
           @if ($value) value="{{ $value }}"
           @else
           value="{{ isset($attributes['entity']) && isset($attributes['entity'][$name]) ? $attributes['entity'][$name] : old($name) }}"> @endif
    @error($name)
    <span class="invalid-feedback block d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
