
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | PerpusDigital</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="app-body">

    <div class="app-shell">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <a class="brand" href="{{ route('dashboard') }}">
                <span class="brand-mark">
                    📚
                </span>

                <span>
                    <b>PerpusDigital</b>
                    <small>Library Management</small>
                </span>
            </a>

            <div class="nav-label">
                MENU UTAMA
            </div>

            <nav class="nav-links">

                <a href="{{ route('dashboard') }}">
                    ▦
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('books.index') }}">
                    📖
                    <span>Daftar Buku</span>
                </a>

                <a href="{{ route('categories.index') }}">
                    🗂️
                    <span>Kategori</span>
                </a>

                <a href="{{ route('borrowings.index') }}">
                    ↔
                    <span>Peminjaman</span>
                </a>

            </nav>

            <div class="sidebar-bottom">
                Sistem Informasi Perpustakaan
            </div>

        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-area">

            <!-- TOPBAR -->
            <header class="topbar">

                <div>
                    <small class="eyebrow">
                        PERPUSDIGITAL
                    </small>

                    <strong>Dashboard</strong>
                </div>

                <div class="user-chip">

                    <span class="avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>

                    <span>
                        <b>{{ auth()->user()->name }}</b>

                        <small>
                            {{ ucfirst(auth()->user()->role) }}
                        </small>
                    </span>

                </div>

            </header>

            <!-- CONTENT -->
            <section class="content">

                <!-- WELCOME BANNER -->
                <div class="hero">

                    <div>

                        <span class="eyebrow light">
                            DASHBOARD PERPUSTAKAAN
                        </span>

                        <h1>
                            Selamat datang, {{ auth()->user()->name }} 👋
                        </h1>

                        <p>
                            Pantau koleksi buku dan aktivitas perpustakaan
                            dari satu tempat.
                        </p>

                    </div>

                    <div class="hero-art">
                        📚
                    </div>

                </div>

                <!-- NOTIFIKASI BERHASIL -->
                @if (session('success'))

                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>

                @endif

                <!-- NOTIFIKASI ERROR -->
                @if (session('error'))

                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>

                @endif

                <!-- VALIDASI FORM -->
                @if ($errors->any())

                    <div class="alert alert-error">

                        <b>Periksa kembali:</b>

                        <ul>
                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach
                        </ul>

                    </div>

                @endif

                <!-- JUDUL STATISTIK -->
                <div class="section-title">

                    <div>
                        <h2>Ringkasan Perpustakaan</h2>

                        <p>
                            Informasi data perpustakaan saat ini.
                        </p>
                    </div>

                </div>

                <!-- STATISTIK -->
                <div class="stats-grid">

                    <!-- TOTAL BUKU -->
                    <div class="stat-card">

                        <div class="stat-top">
                            <span>Total Buku</span>
                            <i>📚</i>
                        </div>

                        <strong>
                            {{ $totalBooks }}
                        </strong>

                        <small>Koleksi buku</small>

                    </div>

                    <!-- TOTAL KATEGORI -->
                    <div class="stat-card">

                        <div class="stat-top">
                            <span>Kategori</span>
                            <i>🗂️</i>
                        </div>

                        <strong>
                            {{ $totalCategories }}
                        </strong>

                        <small>Jenis kategori</small>

                    </div>

                    <!-- TOTAL ANGGOTA -->
                    <div class="stat-card">

                        <div class="stat-top">
                            <span>Anggota</span>
                            <i>👥</i>
                        </div>

                        <strong>
                            {{ $totalMembers }}
                        </strong>

                        <small>Anggota terdaftar</small>

                    </div>

                    <!-- TOTAL PEMINJAMAN -->
                    <div class="stat-card">

                        <div class="stat-top">
                            <span>Peminjaman</span>
                            <i>📋</i>
                        </div>

                        <strong>
                            {{ $totalBorrowings }}
                        </strong>

                        <small>Total transaksi</small>

                    </div>

                </div>

                <!-- AKSES CEPAT -->
                <div class="section-title">

                    <div>
                        <h2>Akses Cepat</h2>

                        <p>
                            Pilih menu untuk mulai mengelola perpustakaan.
                        </p>
                    </div>

                </div>

                <div class="quick-grid">

                    <!-- MENU BUKU -->
                    <a class="quick-card"
                       href="{{ route('books.index') }}">

                        <i>📖</i>

                        <b>Daftar Buku</b>

                        <small>
                            Lihat dan kelola koleksi
                        </small>

                        <span>→</span>

                    </a>

                    <!-- MENU KATEGORI -->
                    <a class="quick-card"
                       href="{{ route('categories.index') }}">

                        <i>🗂️</i>

                        <b>Kategori</b>

                        <small>
                            Kelola kategori buku
                        </small>

                        <span>→</span>

                    </a>

                    <!-- MENU PEMINJAMAN -->
                    <a class="quick-card"
                       href="{{ route('borrowings.index') }}">

                        <i>📋</i>

                        <b>Peminjaman</b>

                        <small>
                            Pantau transaksi buku
                        </small>

                        <span>→</span>

                    </a>

                </div>

                <!-- INFORMASI AKUN -->
                <div class="content-card account-card">

                    <div class="section-title">

                        <div>
                            <h2>Informasi Akun</h2>

                            <p>
                                Detail akun yang sedang digunakan.
                            </p>
                        </div>

                    </div>

                    <div class="account-grid">

                        <div>
                            <small>Nama</small>

                            <b>
                                {{ auth()->user()->name }}
                            </b>
                        </div>

                        <div>
                            <small>Email</small>

                            <b>
                                {{ auth()->user()->email }}
                            </b>
                        </div>

                        <div>
                            <small>Hak akses</small>

                            <b>
                                {{ ucfirst(auth()->user()->role) }}
                            </b>
                        </div>

                    </div>

                    <!-- LOGOUT -->
                    <form action="{{ route('logout') }}" method="POST">

                        @csrf

                        <button class="btn btn-danger" type="submit">
                            Keluar dari akun
                        </button>

                    </form>

                </div>

                <!-- FOOTER -->
                <footer class="footer-note">

                    © {{ date('Y') }} PerpusDigital ·
                    Sistem Informasi Perpustakaan

                </footer>

            </section>

        </main>

    </div>

</body>
</html>
