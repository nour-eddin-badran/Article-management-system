<?php

namespace Tests\Unit;

use App\Dtos\ArticleDto;
use App\Events\ArticleAddedEvent;
use App\Events\ArticlePublishedEvent;
use App\Exceptions\UserException;
use App\Models\Article;
use App\Models\User;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use App\Modules\EnumManager\Enums\UserTypeEnum;
use App\Services\ArticleService;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private ArticleService $articleService;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
        Queue::fake();
        Artisan::call('db:seed');

        $this->articleService = app(ArticleService::class);
    }

    public function testUserCanAddArticle()
    {
        $author = User::factory()->create();
        $this->actingAs($author);

        $article = Article::factory([
            'author_id' => $author->id
        ])->make();

        $this->articleService->add(new ArticleDto($article->title, $article->description, $article->author_id));

        $this->assertDatabaseHas('articles', [
            'title' => $article->title,
            'description' => $article->description,
            'author_id' => $author->id,
            'is_approved' => 0,
            'views_count' => 0
        ]);

        // check if the ArticleAddedEvent were dispatched
        Event::assertDispatched(ArticleAddedEvent::class);
    }

    public function testAuthorCanUpdateHisArticle()
    {
        $author = User::factory()->create();
        $this->actingAs($author);

        $article = Article::factory([
            'author_id' => $author->id
        ])->create();

        $updatedTitle = $this->faker->sentence;
        $updatedDescription = $this->faker->sentence;
        $this->articleService->update($article, new ArticleDto($updatedTitle, $updatedDescription, $article->author_id));

        $this->assertDatabaseHas('articles', [
            'title' => $updatedTitle,
            'description' => $updatedDescription,
            'author_id' => $article->author_id,
            'is_approved' => 0,
            'views_count' => 0
        ]);
    }

    public function testOnlyAuthorCanUpdateHisArticle()
    {
        $author = User::factory()->create();
        $this->actingAs($author);

        $article = Article::factory([
            'author_id' => $author->id
        ])->create();

        $anotherAuthor = User::factory()->create();
        $this->actingAs($anotherAuthor);

        $updatedTitle = $this->faker->sentence;
        $updatedDescription = $this->faker->sentence;


        $this->assertThrows(
            fn () => $this->articleService->update($article, new ArticleDto($updatedTitle, $updatedDescription, $article->author_id)),
            UserException::class
        );

        // check that the article has not being updated
        $this->assertDatabaseHas('articles', [
            'title' => $article->title,
            'description' => $article->description,
            'author_id' => $article->author_id,
            'is_approved' => 0,
            'views_count' => 0
        ]);
    }


    public function testAuthorCanDeleteArticle()
    {
        $author = User::factory()->create();
        $this->actingAs($author);

        $article = Article::factory([
            'author_id' => $author->id
        ])->create();

        $this->articleService->destroy($article);
        $this->assertDatabaseEmpty('articles');
    }

    public function testOnlyAuthorCanDeleteHisArticle()
    {
        $author = User::factory()->create();
        $this->actingAs($author);

        $article = Article::factory([
            'author_id' => $author->id
        ])->create();

        $anotherAuthor = User::factory()->create();
        $this->actingAs($anotherAuthor);

        $this->assertThrows(
            fn () => $this->articleService->destroy($article),
            UserException::class
        );

        // check that the article is still in the database
        $this->assertDatabaseHas('articles', [
            'title' => $article->title,
            'description' => $article->description,
            'author_id' => $article->author_id,
            'is_approved' => 0,
            'views_count' => 0
        ]);
    }

    public function testVisitorsCanOnlySeeThePublishedArticles()
    {
        Article::factory([
            'is_approved' => 1
        ])->count(2)->create();

        Article::factory([
            'is_approved' => 0
        ])->count(3)->create();

        $result = $this->articleService->getPublishedArticles();
        $this->assertCount(2, $result);
    }

    public function testAdminCanApproveAnArticle()
    {
        $author = User::factory()->create();
        $this->actingAs($author);

        $article = Article::factory([
            'author_id' => $author->id
        ])->create();

        $admin = User::factory([
            'type' => UserTypeEnum::MANAGERIAL
        ])->create();
        $this->actingAs($admin);

        $admin->assignRole(RoleTypeEnum::ADMIN);
        $this->articleService->publish($article);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'is_approved' => 1,
        ]);

        // check if the ArticlePublishedEvent were dispatched
        Event::assertDispatched(ArticlePublishedEvent::class);
    }

    public function testOnlyAdminCanApproveAnArticle()
    {
        $author = User::factory()->create();
        $this->actingAs($author);

        $article = Article::factory([
            'author_id' => $author->id
        ])->create();

        $this->assertThrows(
            fn () => $this->articleService->publish($article),
            UserException::class
        );

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'is_approved' => 0,
        ]);

        // check if the ArticlePublishedEvent were dispatched
        Event::assertNotDispatched(ArticlePublishedEvent::class);
    }

    public function testOnlyWhenVisitorSeeOtherUserArticlesWeIncreaseArticleViewsCount()
    {
        $author = User::factory()->create();
        $this->actingAs($author);

        $article = Article::factory([
            'author_id' => $author->id,
            'is_approved' => 1
        ])->create();

        $this->articleService->updateViews($article);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'views_count' => 0,
        ]);

        $visitor = User::factory()->create();
        $this->actingAs($visitor);

        $this->articleService->updateViews($article);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'views_count' => 1,
        ]);
    }
}
