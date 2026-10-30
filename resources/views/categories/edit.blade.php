<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                Edit Kategori | PerpusDigital
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
                                Edit Kategori
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
                                    Edit Kategori
                                </h1>
                                <p>
                                    Perbarui nama atau deskripsi kategori.
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
                            <form action="{{ route('categories.update', $category) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>
                                        Nama Kategori
                                    </label>
                                    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Deskripsi
                                    </label>
                                    <textarea name="description" rows="5">
                                        {{ old('description', $category->description ?? '') }}
                                    </textarea>
                                </div>
                                <div class="form-actions">
                                    <button class="btn btn-primary" type="submit">
                                        Simpan
                                    </button>
                                    <a class="btn btn-light" href="{{ route('categories.index') }}">
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
