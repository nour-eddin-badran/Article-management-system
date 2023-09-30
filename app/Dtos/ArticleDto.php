<?php

namespace App\Dtos;

class ArticleDto
{
    public function __construct(private string $title, private string $description, private int $authorId) { }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }
}