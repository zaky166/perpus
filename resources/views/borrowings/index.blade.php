<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                Peminjaman Buku | PerpusDigital
            </title>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        </head>
        <body class="app-body">
            <div class="app-shell">
                <aside class="sidebar">
                    <a class="brand" href="{{ route('dashboard') }}">
                        <span class="brand-mark">
                            📚
                        </span>
                        <span>
                            <b>
                                PerpusDigital
                            </b>
                            <small>
                                Library Management
                            </small>
                        </span>
                    </a>
                    <div class="nav-label">
                        MENU UTAMA
                    </div>
                    <nav class="nav-links">
                        <a href="{{ route('dashboard') }}">
                            ▦
                            <span>
                                Dashboard
                            </span>
                        </a>
                        <a href="{{ route('books.index') }}">
                            📖
                            <span>
                                Daftar Buku
                            </span>
                        </a>
                        <a href="{{ route('categories.index') }}">
                            🗂️
                            <span>
                                Kategori
                            </span>
                        </a>
                        <a href="{{ route('borrowings.index') }}">
                            ↔
                            <span>
                                Peminjaman
                            </span>
                        </a>
                    </nav>
                    <div class="sidebar-bottom">
                        Sistem Informasi Perpustakaan
                    </div>
                </aside>
                <main class="main-area">
                    <header class="topbar">
                        <div>
                            <small class="eyebrow">
                                PERPUSDIGITAL
                            </small>
                            <strong>
                                Peminjaman Buku
                            </strong>
                        </div>
                        <div class="user-chip">
                            <span class="avatar">
                                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                            </span>
                            <span>
                                <b>
                                    {{ auth()->user()->name }}
                                </b>
                                <small>
                                    {{ ucfirst(auth()->user()->role) }}
                                </small>
                            </span>
                        </div>
                    </header>
                    <section class="content">
                        <div class="page-intro">
                            <div>
                                <h1>
                                    Peminjaman Buku
                                </h1>
                                <p>
                                    Pantau permintaan, status, dan pengembalian buku.
                                </p>
                            </div>
                            <a class="btn btn-light" href="{{ route('books.index') }}">
                                ← Katalog Buku
                            </a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-error">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-error">
                                <b>
                                    Periksa kembali:
                                </b>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="content-card">
                            <div class="table-toolbar">
                                <div>
                                    <h2>
                                        Data Peminjaman Buku
                                    </h2>
                                    <p>
                                        Daftar informasi yang tersimpan.
                                    </p>
                                </div>
                            </div>
                            <div class="table-wrap">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Anggota
                                            </th>
                                            <th>
                                                Buku
                                            </th>
                                            <th>
                                                Tanggal Pinjam
                                            </th>
                                            <th>
                                                Tenggat
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($borrowings as $borrowing)
                                            <tr>
                                                <td>
                                                    <b>
                                                        {{ $borrowing->user->name }}
                                                    </b>
                                                </td>
                                                <td>
                                                    {{ $borrowing->book->title }}
                                                </td>
                                                <td>
                                                    {{ $borrowing->borrow_date->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    {{ $borrowing->due_date->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    <span class="status-pill status-{{ $borrowing->status }}">
                                                        {{ ucfirst($borrowing->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if (in_array(auth()->user()->role, ['admin','petugas'], true))
                                                        <div class="action-group">
                                                            @if ($borrowing->status === 'menunggu')
                                                                <form method="POST" action="{{ route('borrowings.approve',$borrowing) }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button class="btn btn-primary" type="submit">
                                                                        Setujui
                                                                    </button>
                                                                </form>
                                                                <form method="POST" action="{{ route('borrowings.reject',$borrowing) }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button class="btn btn-danger" type="submit">
                                                                        Tolak
                                                                    </button>
                                                                </form>
                                                                @elseif ($borrowing->status === 'dipinjam')
                                                                <form method="POST" action="{{ route('borrowings.return',$borrowing) }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button class="btn btn-success" type="submit">
                                                                        Kembalikan
                                                                    </button>
                                                                </form>
                                                                @else
                                                                <span class="muted">
                                                                    Tidak ada aksi
                                                                </span>
                                                            @endif
                                                        </div>
                                                        @else
                                                        <span class="muted">
                                                            —
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="empty-state">
                                                    Belum ada transaksi peminjaman.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination-wrap">
                                {{ $borrowings->links() }}
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </body>
    </html>
