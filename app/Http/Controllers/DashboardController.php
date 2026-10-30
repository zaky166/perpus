<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalBooks' => Book::count(),
            'totalCategories' => Category::count(),
            'totalMembers' => User::where('role', 'anggota')->count(),
            'totalBorrowings' => Borrowing::count(),
        ]);
    }
}