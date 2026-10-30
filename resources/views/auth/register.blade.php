<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                Registrasi | PerpusDigital
            </title>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        </head>
        <body class="auth-body">
            <div class="auth-card">
                <div class="auth-logo">
                    📚
                </div>
                <span class="eyebrow">
                    PERPUSDIGITAL
                </span>
                <h1>
                    Buat akun baru
                </h1>
                <p class="auth-subtitle">
                    Daftar untuk mulai menggunakan perpustakaan digital.
                </p>
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
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>
                            Nama
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>
                            Email
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                    </div>
                    <div class="form-group">
                        <label>
                            Password minimal 8 karakter
                        </label>
                        <input type="password" name="password" placeholder="Buat password" required>
                    </div>
                    <div class="form-group">
                        <label>
                            Ulangi Password
                        </label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">
                        Daftar
                    </button>
                </form>
                <p class="auth-bottom">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                </p>
            </div>
        </body>
    </html>
