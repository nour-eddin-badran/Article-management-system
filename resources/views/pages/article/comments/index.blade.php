@foreach($comments as $comment)
    <div class="d-flex flex-start">
        <img class="rounded-circle shadow-1-strong me-3"
             src="{{$comment->user->getFirstMediaUrl('avatar')}}" alt="avatar" width="60"
             height="60" />
        <div>
            <h6 class="fw-bold mb-1">{{$comment->user->name}}</h6>
            <div class="d-flex align-items-center mb-3">
                <p class="mb-0">
                    {{$comment->created_at->diffForHumans()}}
                </p>
                <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
                <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a>
            </div>
            <p class="mb-0">
                {{$comment->content}}
            </p>
        </div>
    </div>
@endforeach
