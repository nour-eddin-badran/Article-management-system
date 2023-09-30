<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\ArticleDto;
use App\Http\Requests\Article\AddArticleRequest;
use App\Traits\MessageHandleHelper;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Article;
use App\Models\User;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends BaseController
{
    use MessageHandleHelper;

    public function __construct(private ArticleService $articleService) {
        parent::__construct();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $articles = $this->articleService->getDataForDatatable();

            return prepareDataTable($articles, 'articles');
        }

        return view('pages.article.index');
    }

    public function store(AddArticleRequest $request)
    {
        $this->articleService->add(new ArticleDto($request->title, $request->description, authUser()->id));
        return $this->successResponse();
    }

    public function show(Article $article)
    {
        $this->articleService->updateViews($article);

        return view('pages.article.show', [
            'article' => $article
        ]);
    }

    public function edit(Article $article)
    {
        if (!$this->articleService->isOwner(authUser(), $article) && !authUser()->hasRole(RoleTypeEnum::ADMIN)) {
            return view('pages.error.404');
        }

        $page = 'update';

        if (authUser()->hasRole(RoleTypeEnum::ADMIN)) {
            $page = 'show';
        }

        return view("pages.article.{$page}", [
            'article' => $article
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $this->articleService->update($article, new ArticleDto($request->title, $request->description, authUser()->id));

        return view('pages.article.show', [
            'article' => $article
        ]);
    }

    public function destroy(Article $article)
    {
        $this->articleService->destroy($article);
        return $this->successResponse();
    }

}