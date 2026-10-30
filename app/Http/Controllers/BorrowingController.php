<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    private function checkStaff(): void
    {
        abort_unless(
            in_array(auth()->user()->role, ['admin', 'petugas'], true),
            403
        );
    }

    public function index()
    {
        $query = Borrowing::with(['user', 'book'])->latest();

        if (auth()->user()->role === 'anggota') {
            $query->where('user_id', auth()->id());
        }

        $borrowings = $query->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    public function store(Book $book)
    {
        abort_unless(auth()->user()->role === 'anggota', 403);

        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis.');
        }

        $alreadyBorrowed = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Kamu masih memiliki permintaan atau peminjaman buku ini.');
        }

        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
            'status' => 'menunggu',
        ]);

        return redirect()->route('borrowings.index')
            ->with('success', 'Permintaan peminjaman berhasil diajukan.');
    }

    public function approve(Borrowing $borrowing)
    {
        $this->checkStaff();

        DB::transaction(function () use ($borrowing) {
            $loan = Borrowing::whereKey($borrowing->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($loan->status !== 'menunggu') {
                abort(422, 'Permintaan ini sudah diproses.');
            }

            $book = Book::whereKey($loan->book_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($book->stock < 1) {
                abort(422, 'Stok buku habis.');
            }

            $book->decrement('stock');

            $loan->update([
                'status' => 'dipinjam',
                'borrow_date' => now()->toDateString(),
                'due_date' => now()->addDays(7)->toDateString(),
            ]);
        });

        return back()->with('success', 'Peminjaman disetujui.');
    }

    public function reject(Borrowing $borrowing)
    {
        $this->checkStaff();

        if ($borrowing->status !== 'menunggu') {
            return back()->with('error', 'Hanya permintaan yang menunggu yang dapat ditolak.');
        }

        $borrowing->update(['status' => 'ditolak']);

        return back()->with('success', 'Permintaan peminjaman ditolak.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        $this->checkStaff();

        DB::transaction(function () use ($borrowing) {
            $loan = Borrowing::whereKey($borrowing->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($loan->status !== 'dipinjam') {
                abort(422, 'Buku ini tidak sedang dipinjam.');
            }

            $book = Book::whereKey($loan->book_id)
                ->lockForUpdate()
                ->firstOrFail();

            $book->increment('stock');

            $loan->update([
                'status' => 'dikembalikan',
                'returned_at' => now(),
            ]);
        });

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}