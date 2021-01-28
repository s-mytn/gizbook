<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Services\BookService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var BookService
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = app()->make(BookService::class);
    }

    /**
     * @test
     */
    public function 指定の本IDで指定の本を一件取得できること()
    {
        $fake = factory(Book::class)->create();
        $actual = $this->service->getBookById($fake->id);

        $this->assertSame($fake->id, $actual->id);

        $actual = $this->service->getBookById(999);
        $this->assertNull($actual);
    }

    /**
     * 本を一件作成できること
     *
     * @return void
     */
    public function testCreateBook()
    {
        $this->service->createBook(['name' => 'あべ大好き']);
        $actual = Book::first();
        
        $this->assertSame('あべ大好き', $actual->name);
    }

    /**
     * @test
     */
    public function 指定の本IDで指定の値で更新できること()
    {
        $fake = factory(Book::class)->create(['name' => 'あべ大嫌い']);
        $this->service->updateBookById($fake->id, ['name' => 'あべ大好き']);
        $actual = Book::find($fake->id);
        
        $this->assertSame('あべ大好き', $actual->name);
    }

    /**
     * @test
     */
    public function 指定の本IDで本を一件削除できること()
    {
        // 宿題
        // $this->assertEmpty() or $this->assert()
    }
}
