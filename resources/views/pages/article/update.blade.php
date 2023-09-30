@extends('layout.master')

@section('form-route'){{route('articles.update', $article->id)}}@endsection
@section('form-method') @method('put') @endsection

@section('title')<h4 class="card-title">{{__('admin.update')}}</h4>@endsection

@push('custom-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
@endpush

@section('content')

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{!! route('admin.articles.index') !!}">{{__('common.articles')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$article->name}}</li>
        </ol>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="articles-overview-tab" data-toggle="tab" href="#articles-overview" role="tab"
               aria-controls="articles-overview-tab" aria-selected="true">{{__('common.overview')}}</a>
        </li>
    </ul>

    <div class="row">
        <div class="tab-content border border-top-0 p-3 w-100" id="myTabContent">
            <div class="tab-pane fade show active" id="articles-overview" role="tabpanel" aria-labelledby="articles-overview-tab">
                @include('pages.article.form', [
                    'article' => $article,
                    'source' => 'update'
                ])
            </div>
        </div>
    </div>
@endsection