<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                Detail Buku | PerpusDigital
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
                                Detail Buku
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
                                    Detail Buku
                                </h1>
                                <p>
                                    Informasi lengkap koleksi buku.
                                </p>
                            </div>
                            <a class="btn btn-light" href="{{ route('books.index') }}">
                                ← Kembali
                            </a>
                        </div>
                        <div class="content-card detail-card">
                            <div class="detail-cover">
                                📖
                            </div>
                            <div class="detail-info">
                                <h2>
                                    {{ $book->title }}
                                </h2>
                                <p class="muted">
                                    {{ $book->author }}
                                </p>
                                <div class="detail-grid">
                                    <div>
                                        <small>
                                            Kategori
                                        </small>
                                        <b>
                                            {{ $book->category->name }}
                                        </b>
                                    </div>
                                    <div>
                                        <small>
                                            ISBN
                                        </small>
                                        <b>
                                            {{ $book->isbn }}
                                        </b>
                                    </div>
                                    <div>
                                        <small>
                                            Stok
                                        </small>
                                        <b>
                                            {{ $book->stock }}
                                        </b>
                                    </div>
                                    <div>
                                        <small>
                                            Penerbit
                                        </small>
                                        <b>
                                            {{ $book->publisher ?: '—' }}
                                        </b>
                                    </div>
                                    <div>
                                        <small>
                                            Tahun Terbit
                                        </small>
                                        <b>
                                            {{ $book->publication_year ?: '—' }}
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </body>
    </html>
