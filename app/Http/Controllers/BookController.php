<?php

namespace App\Http\Controllers;

use App\Book;
use App\Checkout;
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
        if ($pageNumber != 1) {
            abort_unless($this->userCanRead($book), 403);
            abort_unless($pageNumber >= 1 && $pageNumber <= $book->total_pages, 404);
        }

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
        $loan = $this->getBookBorrowed($book->id);

        return (auth()->check() && $loan != null);
    }

    public function detail(Book $book)
    {
        $loan = null;
        $bookStock = null;
        $routeBack = route('dashboard');

        if (auth()->check()) {
            $loan = $this->getBookBorrowed($book->id);
            $bookStock = 1 - Checkout::where('book_id', $book->id)
                ->whereNull('return_at')
                ->where('expires_at', '>', now())
                ->count();
        }

        return view('books.detail', compact('book', 'loan', 'bookStock', 'routeBack'));
    }

    public function borrow(Book $book)
    {
        abort_unless(auth()->check(), 403);

        // cek supaya tidak dobel pinjam buku yang sama
        $existing = $this->getBookBorrowed($book->id);

        if (!$existing) {
            Checkout::create([
                'book_id' => $book->id,
                'user_id' => auth()->id(),
                'checkout_at' => now(),
                'expires_at' => now()->addDays(14),
            ]);
        }

        return redirect()->route('book.detail', $book->id)
            ->with('success', 'Buku berhasil dipinjam!');
    }

    private function getBookBorrowed(int $bookId)
    {
        return Checkout::where('book_id', $bookId)
                ->where('user_id', auth()->id())
                ->whereNull('return_at')
                ->where('expires_at', '>', now())
                ->first();
    }
}
