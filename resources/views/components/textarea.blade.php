<div class="form-group {{$class}} {{ $required == true ? 'required' : '' }}">
    <label for="{{ $id }}">{{ $label }}</label>

    @isset($note)
        <div class="alert alert-primary" role="alert">
            {{ $note }}
        </div>
    @endisset

    <textarea @if (isset($disabled) && $disabled == true) disabled @endif id="{{ $id }}" name="{{ $name }}"
              class="form-control @error('$name') is-invalid @enderror" rows="8"
              @if (isset($readonly) && $readonly == true) readonly @endif
              placeholder="{{ isset($placeholder) ? $placeholder : __('common.' . $name) }}">{{ isset($attributes['entity']) && isset($attributes['entity'][$name]) ? $attributes['entity'][$name] : old($name) }}</textarea>

    @error($name)
    <span class="invalid-feedback block d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
