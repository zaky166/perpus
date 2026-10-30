<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                Edit Buku | PerpusDigital
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
                                Edit Buku
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
                                    Edit Buku
                                </h1>
                                <p>
                                    Perbarui informasi buku yang dipilih.
                                </p>
                            </div>
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
                        <div class="form-card">
                            <form action="{{ route('books.update', $book) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-grid">
                                    <div class="form-group full">
                                        <label>
                                            Kategori
                                        </label>
                                        <select name="category_id" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id', isset($book) ? $book->
                                                    category_id : '') == $category->id)>{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group full">
                                        <label>
                                            Judul Buku
                                        </label>
                                        <input name="title" value="{{ old('title', $book->title ?? '') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Penulis
                                        </label>
                                        <input name="author" value="{{ old('author', $book->author ?? '') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            ISBN
                                        </label>
                                        <input name="isbn" value="{{ old('isbn', $book->isbn ?? '') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Stok
                                        </label>
                                        <input type="number" name="stock" min="0" value="{{ old('stock', $book->stock ?? 1) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Penerbit
                                        </label>
                                        <input name="publisher" value="{{ old('publisher', $book->publisher ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Tahun Terbit
                                        </label>
                                        <input type="number" name="publication_year" value="{{ old('publication_year', $book->publication_year ?? '') }}">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button class="btn btn-primary" type="submit">
                                        Simpan
                                    </button>
                                    <a class="btn btn-light" href="{{ route('books.index') }}">
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </section>
                </main>
            </div>
        </body>
    </html>
