<form class="p-4" id="bank-form" action="@yield('form-route')" method="post" enctype="multipart/form-data">
    @csrf
    @yield('form-method')

    <x-input id="article-title" label="{{ __('common.title')}}" name="title" :entity="$article ?? ''"/>

    <x-textarea id="article-description" label="{{ __('common.description')}}" name="description" class="d-none" :entity="$article ?? ''" />

    <div class="form-group required">
    <label for="description">{{ __('common.description')  }}</label>
    <div id="editor">
        @isset($article)
             {!! $article->description !!}
        @endisset
    </div>

    </div>

    {{--<x-input id="article-cover" type="file" label="{{ __('common.cover')}}" name="cover" :entity="$article ?? ''"/>--}}
    <x-file id="article-cover" label="{{ __('common.cover') }}"
            name="cover" :entity="$article ?? ''" />

    @isset($article)
        <img class="d-block mb-4" src="{{$article->getFirstMediaUrl('cover')}}" style="max-width: 300px; max-height: 200px"/>
    @endisset

    @if(isset($source) && $source == 'update')
        <button id="btn-update" type="submit" class="btn btn-primary mr-2">{{ __('admin.update')}}</button>
        <a id="btn-cancel" href="{{route('admin.articles.index')}}"
           class="btn btn-light">{{__('admin.cancel')}}</a>
    @endif

</form>

@push('custom-scripts')
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    $('#btn-add-article-modal-submit, #btn-update').on('click', function() {
         $('#article-description').val($('.ck-content')[0].innerHTML);
         $('.ck-content')[0].innerHTML = '';
    })

</script>

@endpush