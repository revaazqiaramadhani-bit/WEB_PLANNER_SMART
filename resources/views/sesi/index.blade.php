<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Planner</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #eef2ff;
            display: grid;
            place-items: center;
        }
        .login-shell {
            width: min(920px, calc(100% - 32px));
            min-height: 560px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(67, 56, 202, .16);
        }
        .login-visual {
            color: #fff;
            padding: 48px;
            background: linear-gradient(145deg, #4f46e5 0%, #312e81 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .brand-icon {
            width: 52px; height: 52px; border-radius: 16px;
            display: grid; place-items: center;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.18);
        }
        .visual-circle {
            width: 220px; height: 220px; border-radius: 50%;
            margin: 20px auto;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            display: grid; place-items: center;
        }
        .visual-circle i { font-size: 92px; opacity: .9; }
        .login-form { padding: 48px; display: flex; flex-direction: column; justify-content: center; }
        .form-control {
            min-height: 48px;
            border-radius: 12px;
            border-color: #dde4ef;
        }
        .form-control:focus {
            border-color: #a5b4fc;
            box-shadow: 0 0 0 .22rem rgba(79,70,229,.11);
        }
        .btn-primary { min-height: 48px; border-radius: 12px; background: #4f46e5; border-color: #4f46e5; font-weight: 700; }
        .btn-primary:hover { background: #4338ca; border-color: #4338ca; }
        @media (max-width: 767.98px) {
            .login-shell { grid-template-columns: 1fr; min-height: auto; }
            .login-visual { min-height: 210px; padding: 28px; }
            .visual-circle { width: 120px; height: 120px; position: absolute; right: 28px; bottom: 24px; }
            .visual-circle i { font-size: 52px; }
            .login-visual p { max-width: 70%; }
            .login-form { padding: 32px 28px; }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <section class="login-visual">
            <div class="brand-icon"><i class="bi bi-calendar2-check-fill fs-4"></i></div>
            <div>
                <h1 class="h3 fw-bold mb-3">Atur rencana.<br>Capai targetmu.</h1>
                <p class="mb-0 opacity-75">Kelola jadwal kegiatan dan kategori dengan lebih teratur.</p>
            </div>
            <div class="visual-circle"><i class="bi bi-list-check"></i></div>
        </section>
        <section class="login-form">
            <div class="mb-4">
                <h2 class="h4 fw-bold mb-2">Selamat datang</h2>
                <p class="text-muted mb-0">Masuk untuk membuka Smart Planner.</p>
            </div>
            @if($errors->any())
                <div class="alert alert-danger border-0 py-2 small">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success border-0 py-2 small">{{ session('success') }}</div>
            @endif
            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="nama@email.com" autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    Masuk ke Dashboard
                </button>
            </form>
        </section>
    </div>
</body>
</html>