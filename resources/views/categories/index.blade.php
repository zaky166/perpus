<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                Kategori Buku | PerpusDigital
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
                                Kategori Buku
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
                                    Kategori Buku
                                </h1>
                                <p>
                                    Atur pengelompokan koleksi buku perpustakaan.
                                </p>
                            </div>
                            @if (auth()->user()->role === 'admin')
                                <a class="btn btn-primary" href="{{ route('categories.create') }}">
                                    ＋ Tambah Kategori
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
                                        Data Kategori Buku
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
                                                Nama Kategori
                                            </th>
                                            <th>
                                                Deskripsi
                                            </th>
                                            <th>
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr>
                                                <td>
                                                    <b>
                                                        {{ $category->name }}
                                                    </b>
                                                </td>
                                                <td>
                                                    {{ $category->description ?: '—' }}
                                                </td>
                                                <td>
                                                    <div class="action-group">
                                                        <a class="btn btn-light" href="{{ route('categories.show',$category) }}">
                                                            Detail
                                                        </a>
                                                        @if (auth()->user()->role === 'admin')
                                                            <a class="btn btn-warning" href="{{ route('categories.edit',$category) }}">
                                                                Edit
                                                            </a>
                                                            <form action="{{ route('categories.destroy',$category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="empty-state">
                                                    Belum ada kategori.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination-wrap">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </body>
    </html>
