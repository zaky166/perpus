<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                Login | PerpusDigital
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
                    Selamat datang kembali
                </h1>
                <p class="auth-subtitle">
                    Masuk untuk mengakses perpustakaan digital.
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
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>
                            Email
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                    </div>
                    <div class="form-group">
                        <label>
                            Password
                        </label>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    <label class="remember">
                        <input type="checkbox" name="remember" value="1">
                        Ingat saya
                    </label>
                    <button class="btn btn-primary btn-block" type="submit">
                        Login
                    </button>
                </form>
                <p class="auth-bottom">
                    Belum punya akun?
                    <a href="{{ route('register') }}">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </body>
    </html>
