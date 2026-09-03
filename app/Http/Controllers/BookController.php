<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $pageTitle = 'Home';

        return view('books.index', compact('pageTitle', 'books'));
    }
    public function show(Book $book)
    {
        abort_unless($this->userCanRead($book), 403);

        return view('books.read', compact('book'));
    }

    public function servePage(Book $book, int $pageNumber)
    {
        abort_unless($this->userCanRead($book), 403);
        abort_unless($pageNumber >= 1 && $pageNumber <= $book->total_pages, 404);

        $paddedNumber = str_pad($pageNumber, 3, '0', STR_PAD_LEFT);
        $path = storage_path("app/private/books/{$book->folder}/page_{$paddedNumber}.jpg");

        abort_unless(file_exists($path), 404);

        return response()->file($path, [
            'Content-Type' => 'image/jpeg',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ]);
    }

    private function userCanRead(Book $book): bool
    {
        return auth()->check(); // sesuaikan logic akses/langganan nanti
    }
}
