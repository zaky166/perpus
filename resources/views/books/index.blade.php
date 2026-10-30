<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                Daftar Buku | PerpusDigital
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
                                Daftar Buku
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
                                    Daftar Buku
                                </h1>
                                <p>
                                    Kelola dan lihat koleksi buku perpustakaan.
                                </p>
                            </div>
                            @if (auth()->user()->role === 'admin')
                                <a class="btn btn-primary" href="{{ route('books.create') }}">
                                    ＋ Tambah Buku
                                </a>
                            @endif
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
                                        Data Daftar Buku
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
                                                Judul Buku
                                            </th>
                                            <th>
                                                Kategori
                                            </th>
                                            <th>
                                                ISBN
                                            </th>
                                            <th>
                                                Stok
                                            </th>
                                            <th>
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($books as $book)
                                            <tr>
                                                <td>
                                                    <b>
                                                        {{ $book->title }}
                                                    </b>
                                                    <small class="cell-sub">
                                                        {{ $book->author }}
                                                    </small>
                                                </td>
                                                <td>
                                                    {{ $book->category->name }}
                                                </td>
                                                <td>
                                                    {{ $book->isbn }}
                                                </td>
                                                <td>
                                                    <span class="stock-pill">
                                                        {{ $book->stock }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="action-group">
                                                        <a class="btn btn-light" href="{{ route('books.show',$book) }}">
                                                            Detail
                                                        </a>
                                                        @if (auth()->user()->role === 'admin')
                                                            <a class="btn btn-warning" href="{{ route('books.edit',$book) }}">
                                                                Edit
                                                            </a>
                                                            <form action="{{ route('books.destroy',$book) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                            @elseif ($book->stock > 0)
                                                            <form action="{{ route('borrowings.store',$book) }}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-primary" type="submit">
                                                                    Pinjam
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="empty-state">
                                                    Belum ada data buku.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination-wrap">
                                {{ $books->links() }}
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </body>
    </html>
