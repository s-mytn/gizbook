<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Book;

/**
 * Class BookService
 * @package App\Services
 */
class BookService
{
    /**
     * @var Book
     */
    private $book;

    /**
     * BookService constructor.
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * 指定の本IDで本を一件取得する
     * 
     * @param int $id
     * @return Book|null
     */
    public function getBookById(int $id): ?Book
    {
        return $this->book->find($id);
    }

    /**
     * 本を一件作成する
     * 
     * @param array $attributes
     */
    public function createBook(array $attributes): Book
    {
        return $this->book->create($attributes);
    }

    /**
     * 指定の本IDで更新する
     * 
     * @param int $id
     * @param array $attributes
     */
    public function updateBookById(int $id, array $attributes): void
    {
        $book = $this->book->find($id);
        $book->fill($attributes);
        $book->save();
    }

    /**
     * 指定の本IDで削除する
     * @param int $id
     */
    public function deleteBookById(int $id): void
    {
        $book = $this->book->find($id);
        $book->delete();
    }
}
