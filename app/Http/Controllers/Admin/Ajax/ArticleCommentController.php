<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Dtos\CommentDto;
use App\Http\Controllers\BaseController;
use App\Services\ArticleCommentService;
use App\Traits\MessageHandleHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ArticleCommentController
{
    use MessageHandleHelper;

    public function __construct(private ArticleCommentService $commentService)
    {
    }

    public function index(int $articleId)
    {
        $comments = $this->commentService->getRecentComments($articleId);

        $data = view('pages.article.comments.index', [
            'comments' => $comments
        ])->render();

        return \response([
            'comments' => $data,
            'nextPageUrl' => $comments->toArray()['next_page_url']
        ], Response::HTTP_OK);
    }

    public function store(Request $request, int $articleId)
    {
        $this->commentService->add(new CommentDto($articleId, authUser()->id, $request->content));
        return \response([], Response::HTTP_OK);
    }
}