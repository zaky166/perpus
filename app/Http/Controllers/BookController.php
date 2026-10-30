<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private function checkAdmin(): void
    {
        abort_unless(auth()->user()->role === 'admin', 403);
    }

    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $this->checkAdmin();

        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:200'],
            'author' => ['required', 'string', 'max:150'],
            'isbn' => ['required', 'string', 'max:30', 'unique:books,isbn'],
            'stock' => ['required', 'integer', 'min:0', 'max:100000'],
            'publisher' => ['nullable', 'string', 'max:150'],
            'publication_year' => ['nullable', 'integer', 'min:1000', 'max:' . date('Y')],
        ]);

        Book::create($data);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        $book->load('category');

        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $this->checkAdmin();

        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $this->checkAdmin();

        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:200'],
            'author' => ['required', 'string', 'max:150'],
            'isbn' => ['required', 'string', 'max:30', 'unique:books,isbn,' . $book->id],
            'stock' => ['required', 'integer', 'min:0', 'max:100000'],
            'publisher' => ['nullable', 'string', 'max:150'],
            'publication_year' => ['nullable', 'integer', 'min:1000', 'max:' . date('Y')],
        ]);

        $book->update($data);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $this->checkAdmin();

        if ($book->borrowings()->exists()) {
            return back()->with('error', 'Buku memiliki riwayat peminjaman dan tidak bisa dihapus.');
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}