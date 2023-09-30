@foreach($articles as $article)
<a href="{{route('articles.show', $article->id)}}">
    <div class="card d-inline-block m-2" style="width:330px; height: 350px;">
        <img class="card-img-top" src="{{$article->getFirstMediaUrl('cover')}}" alt="Card image" style="height: 200px; width: 330px">
        <div class="card-body">
            <h4 class="card-title">{{$article->title}}</h4>
            <div class="row">
                <table style="height: 100%; width:100%">
                    <tr style="height: 100%; width:100%">
                        <td>
                            <img class="rounded-circle shadow-1-strong me-3"
                                 src="{{$article->author->getFirstMediaUrl('avatar')}}" alt="avatar" width="60"
                                 height="60" />
                        </td>
                        <td>
                            {{$article->author->name}}
                        </td>
                        <td>
                            {{$article->created_at->diffForHumans()}}
                        </td>
                    </tr>
                    <tr style="height: 100%; width:100%">
                        <td></td>
                        <td>
                            <span>{{$article->views_count}} <i class="fa fa-eye" aria-hidden="true"></i></span>
                        </td>
                        <td>
                            <span>{{$article->comments_count}} <i class="fa-solid fa-comment"></i></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</a>
@endforeach