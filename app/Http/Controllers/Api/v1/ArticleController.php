<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\ArticleService;

class ArticleController extends BaseApiController
{
    public function __construct(private ArticleService $articleService) { }

    public function index()
    {
        $articles = $this->articleService->getPublishedArticles();

        return $this->successResponse($articles);
    }

}