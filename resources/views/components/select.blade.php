@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
@endpush

<div class="form-group {{(!isset($visibility) || (isset($visibility) && $visibility == 'true')) ? '' : 'd-none' }}">
    <label for="{{$id}}">{{$label}}</label>
    <select class="js-example-basic-{{isset($type) ? $type : 'single' }} w-100" {{isset($type) ? $type : ''}} name="{{$name}}" id="{{$id}}">
        @if(!isset($type) || (isset($type) && $type != 'multiple'))
            <option value="" disabled selected>{{__('common.dashes')}}</option>
        @endif
        @if(isset($attributes['resources']))
            @foreach($attributes['resources'] as $resource)

                @if(is_array($attributes['entity_id']))
                    <option value="{{$resource['id']}}" {{in_array($resource['id'], $attributes['entity_id']) ? 'selected' : ''}}>{{ $resource['name'] }}</option>
                @else
                    <option value="{{$resource['id']}}" {{$resource['id'] == $attributes['entity_id'] ? 'selected' : ''}}>{{ $resource['name'] }}</option>
                @endif
            @endforeach
        @endif
    </select>
</div>

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
