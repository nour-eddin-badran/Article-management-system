<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Dtos\CommentDto;
use App\Http\Controllers\BaseController;
use App\Models\Article;
use App\Services\ArticleService;
use App\Traits\MessageHandleHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ArticleController
{
    use MessageHandleHelper;

    public function __construct(private ArticleService $articleService)
    {
    }

    public function search(Request $request)
    {
        $articles = $this->articleService->search($request->get('query'));
        $data = view('pages.article.list', compact('articles'))->render();

        return \response([
            'articles' => $data
        ], Response::HTTP_OK);
    }

    public function publish(Article $article)
    {
        $this->articleService->publish($article);
        return \response([], Response::HTTP_OK);
    }
}