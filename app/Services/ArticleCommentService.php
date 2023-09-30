<?php

namespace App\Services;

use App\Dtos\CommentDto;
use App\Models\ArticleComment;


class ArticleCommentService extends BaseService
{

    public function __construct(protected ArticleComment $comment)
    {
       parent::__construct($comment);
    }

    public function getRecentComments(int $articleId)
    {
        $limit = config('website.items_per_page');
        return $this->comment->whereArticleId($articleId)
            ->orderByDesc('id')
            ->paginate($limit);
    }

    public function add(CommentDto $commentDto): void
    {
        $this->comment->create([
           'article_id' => $commentDto->getArticleId(),
           'user_id' => $commentDto->getUserId(),
           'content' => $commentDto->getContent()
        ]);
    }
}