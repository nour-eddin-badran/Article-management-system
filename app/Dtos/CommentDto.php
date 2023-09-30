<?php

namespace App\Dtos;

class CommentDto
{
    public function __construct(private int $articleId, private int $userId, private string $content) { }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}