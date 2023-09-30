<?php

namespace Tests\Unit;

use App\Dtos\CommentDto;
use App\Models\Article;
use App\Models\User;
use App\Services\ArticleCommentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private ArticleCommentService $commentService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->commentService = app(ArticleCommentService::class);
    }

    public function testBothVisitorOrAuthorCanAddCommentOnAnArticle()
    {
        $author = User::factory()->create();
        $this->actingAs($author);

        $article = Article::factory([
            'author_id' => $author->id,
            'is_approved' => 1
        ])->create();


        $visitor = User::factory()->create();
        $this->actingAs($visitor);

        $visitorContent = $this->faker->sentence;
        $authorContent = $this->faker->sentence;

        $this->commentService->add(new CommentDto($article->id, $visitor->id, $visitorContent));
        $this->commentService->add(new CommentDto($article->id, $author->id, $authorContent));

        $this->assertDatabaseHas('article_comments', [
            'article_id' => $article->id,
            'user_id' => $visitor->id,
            'content' => $visitorContent,
        ]);

        $this->assertDatabaseHas('article_comments', [
            'article_id' => $article->id,
            'user_id' => $author->id,
            'content' => $authorContent,
        ]);
    }
}
