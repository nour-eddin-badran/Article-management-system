<?php

namespace App\Services;

use App\Events\ArticleAddedEvent;
use App\Events\ArticlePublishedEvent;
use App\Exceptions\UserException;
use App\Http\Resources\Api\PaginatedCollection;
use App\Models\Article;
use App\Dtos\ArticleDto;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\Api\Article as ArticleApiResource;
use App\Models\User;
use App\Modules\EnumManager\Enums\GeneralEnum;
use App\Modules\EnumManager\Enums\PermissionTypeEnum;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use Illuminate\Http\Response;

class ArticleService extends BaseService
{

    public function __construct(protected Article $article)
    {
       parent::__construct($article);
    }

    protected $relations = [
        'author'
    ];

    public function getDataForDatatable()
    {
        $query = $this->getQuery();

        if (authUser()->hasRole(RoleTypeEnum::AUTHOR)) {
            $query->whereAuthorId(authUser()->id);
        }

        $result = $query->get();

        return ArticleResource::collection($result);
    }

    public function getPublishedArticles()
    {
        $limit = config('website.items_per_page');
        $articles = $this->article->with(['author', 'comments.user'])->approved()
            ->orderByDesc('id')
            ->paginate($limit);

        return new PaginatedCollection($articles, ArticleApiResource::class);
    }

    public function search(?string $search = null)
    {
        $query =  $this->article->with('author')->withCount('comments');

        if ($search) {
            $query->whereRaw('match (title, description) against (? in boolean mode)', [$search]);
        }

        return $query->approved()
        ->orderByDesc('id')
        ->get();
    }

    public function add(ArticleDto $articleDto): Article
    {
        $article = $this->article->create([
           'title' => $articleDto->getTitle(),
           'description' => $articleDto->getDescription(),
           'author_id' => $articleDto->getAuthorId(),
        ]);

        if (request()->hasFile('cover')) {
            $article->addMedia(request()->file('cover'))->toMediaCollection('cover');
        }

        ArticleAddedEvent::dispatch($article);

        return $article;
    }

    public function update(Article $article, ArticleDto $articleDto): void
    {
        if (!$this->isOwner(authUser(), $article)) {
            throw new UserException(__('messages.you_are_not_the_article_owner'), GeneralEnum::NOT_ALLOWED, Response::HTTP_NOT_ACCEPTABLE);
        }

        $article->update([
            'title' => $articleDto->getTitle(),
            'description' => $articleDto->getDescription(),
            'author_id' => $articleDto->getAuthorId(),
        ]);

        if (request()->hasFile('cover')) {
            $article->clearMediaCollection('cover');
            $article->addMedia(request()->file('cover'))->toMediaCollection('cover');
        }
    }

    public function destroy(Article $article): void
    {
        if (!$this->isOwner(authUser(), $article)) {
            throw new UserException(__('messages.you_are_not_the_article_owner'), GeneralEnum::NOT_ALLOWED, Response::HTTP_NOT_ACCEPTABLE);
        }

        $article->delete();
    }

    public function updateViews(Article $article) :void
    {
        if (!$this->isOwner(authUser(), $article)) {
            $article->update([
                'views_count' => $article->views_count + 1
            ]);
        }
    }

    public function publish(Article $article): void
    {
        if (!authUser()->hasPermissionTo(PermissionTypeEnum::ARTICLE_APPROVE_PERMISSION)) {
            throw new UserException(__('messages.only_admin_can_approve_articles'), GeneralEnum::NOT_ALLOWED, Response::HTTP_NOT_ACCEPTABLE);
        }

            $article->update([
                'is_approved' => 1
            ]);

        ArticlePublishedEvent::dispatch($article);
    }

    public static function isPending(Article $article): bool
    {
        return $article->is_approved == 0;
    }

    public function isOwner(User $user, Article $article): bool
    {
        return $article->author_id == $user->id;
    }
}