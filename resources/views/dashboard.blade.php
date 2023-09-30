@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')

    <h3  id="there-is-results" class="m-3 d-none">{{__('common.published_articles')}}</h3>
    <h3 id="no-results" class="m-3 d-none">{{__('common.no_published_articles_yet')}}</h3>
    <div class="continaer" id="articles-container" >

    </div>
@endsection

@push('custom-scripts')
    <script>

        callApi(`{{route('articles.search')}}`, 'GET', null, (data) => {
            $('#articles-container').append(data.articles);
            check(data.articles);
        })

       $('#navbarForm').on('keydown', function(e) {
          var query = $(this).val();

           if(e.key === 'Enter') {
               $('#articles-container').empty();

               callApi(`{{route('articles.search')}}?query=${query}`, 'GET', null, (data) => {
                   $('#articles-container').append(data.articles);
                   check(data.articles);
               });
           }
       });

        function check(articles) {
            if (articles !== "") {
                $('#there-is-results').removeClass('d-none');
                $('#no-results').addClass('d-none');
            } else {
                $('#no-results').removeClass('d-none');
                $('#there-is-results').addClass('d-none');
            }
        }

    </script>
@endpush
