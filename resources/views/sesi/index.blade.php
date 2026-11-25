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
        :root {
            --login-primary: #786bd6;
            --login-primary-dark: #6558bf;
            --login-ink: #35344a;
            --login-muted: #858395;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--login-ink);
            background:
                radial-gradient(circle at 12% 18%, rgba(224, 218, 255, .8), transparent 24rem),
                radial-gradient(circle at 88% 82%, rgba(255, 226, 214, .72), transparent 25rem),
                #faf9fc;
            display: grid;
            place-items: center;
            padding: 32px 0;
        }

        .login-shell {
            width: min(1020px, calc(100% - 40px));
            min-height: 590px;
            display: grid;
            grid-template-columns: 1.02fr .98fr;
            background: #fff;
            border: 1px solid rgba(238, 237, 244, .9);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 28px 80px rgba(72, 65, 111, .12);
        }

        .login-visual {
            position: relative;
            isolation: isolate;
            overflow: hidden;
            color: var(--login-ink);
            padding: 44px 48px 38px;
            background: linear-gradient(145deg, #e8e4ff 0%, #f5eaff 52%, #ffebe3 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .login-visual::before,
        .login-visual::after {
            content: "";
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            pointer-events: none;
        }

        .login-visual::before {
            width: 280px;
            height: 280px;
            right: -112px;
            top: -115px;
            background: rgba(255, 255, 255, .34);
        }

        .login-visual::after {
            width: 230px;
            height: 230px;
            left: -135px;
            bottom: -132px;
            background: rgba(238, 186, 178, .2);
        }

        .brand-lockup {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 15px;
            display: grid; place-items: center;
            color: #fff;
            background: linear-gradient(135deg, #a89ce9, #786bd6);
            box-shadow: 0 9px 20px rgba(120, 107, 214, .24);
        }

        .brand-caption {
            display: block;
            margin-top: 2px;
            color: #77738c;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .12em;
        }

        .visual-copy { margin-top: auto; }
        .visual-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #7067a8;
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .1em;
        }
        .visual-copy h1 {
            margin: 14px 0 12px;
            font-size: clamp(2rem, 3.2vw, 2.65rem);
            line-height: 1.18;
            letter-spacing: -.045em;
        }
        .visual-copy p {
            max-width: 350px;
            color: #706e83;
            line-height: 1.75;
            margin-bottom: 0;
        }

        .visual-art {
            position: relative;
            display: grid;
            place-items: center;
            min-height: 190px;
            margin: 4px 0 8px;
        }
        .visual-circle {
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .48);
            border: 1px solid rgba(255, 255, 255, .72);
            box-shadow: inset 0 0 30px rgba(255, 255, 255, .45);
            display: grid;
            place-items: center;
        }
        .visual-circle i {
            color: #8d81d9;
            font-size: 74px;
        }
        .floating-note {
            position: absolute;
            right: 2px;
            bottom: 12px;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 15px;
            background: rgba(255, 255, 255, .94);
            border: 1px solid rgba(255, 255, 255, .9);
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(78, 70, 110, .1);
            font-size: .75rem;
            color: var(--login-muted);
        }
        .floating-note strong {
            display: block;
            margin-top: 2px;
            color: var(--login-ink);
            font-size: .82rem;
        }
        .note-check { color: #78ad91; font-size: 1.15rem; }

        .login-form {
            padding: 56px 58px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-kicker {
            color: var(--login-primary-dark);
            font-size: .7rem;
            font-weight: 800;
            letter-spacing: .12em;
        }
        .login-form h2 { color: var(--login-ink); letter-spacing: -.035em; }
        .login-form .text-muted { color: var(--login-muted) !important; }
        .login-form .form-label { color: #504f62; }
        .form-control {
            min-height: 50px;
            border-radius: 13px;
            border-color: #e8e6ef;
            padding-left: 15px;
            color: var(--login-ink);
        }
        .form-control:focus {
            border-color: #b8afea;
            box-shadow: 0 0 0 .22rem rgba(120, 107, 214, .12);
        }
        .form-control::placeholder { color: #aaa8b7; }
        .btn-primary {
            min-height: 50px;
            border-radius: 13px;
            background: var(--login-primary);
            border-color: var(--login-primary);
            font-weight: 700;
            box-shadow: 0 9px 18px rgba(120, 107, 214, .19);
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
        }
        .btn-primary:hover {
            background: var(--login-primary-dark);
            border-color: var(--login-primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 12px 22px rgba(120, 107, 214, .24);
        }

        @media (max-width: 767.98px) {
            .login-shell { grid-template-columns: 1fr; min-height: auto; }
            .login-visual { min-height: 390px; padding: 28px; }
            .visual-art { min-height: 150px; margin: 8px 0 0; }
            .visual-circle { width: 132px; height: 132px; }
            .visual-circle i { font-size: 58px; }
            .floating-note { right: 0; bottom: 0; }
            .login-form { padding: 38px 30px 42px; }
        }

        @media (max-width: 420px) {
            .login-shell { width: calc(100% - 24px); border-radius: 22px; }
            .login-visual { min-height: 360px; padding: 24px; }
            .visual-copy h1 { font-size: 1.85rem; }
            .visual-copy p { font-size: .9rem; }
            .login-form { padding: 32px 24px 36px; }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <section class="login-visual">
            <div class="brand-lockup">
                <span class="brand-icon"><i class="bi bi-calendar2-check-fill fs-4"></i></span>
                <span>Smart Planner<small class="brand-caption">PLAN WITH EASE</small></span>
            </div>
            <div class="visual-copy">
                <span class="visual-eyebrow"><i class="bi bi-stars"></i> HARI YANG LEBIH TERATUR</span>
                <h1 class="h3 fw-bold mb-3">Atur rencana.<br>Capai targetmu.</h1>
                <p class="mb-0 opacity-75">Kelola jadwal kegiatan dan kategori dengan lebih teratur.</p>
            </div>
            <div class="visual-art" aria-hidden="true">
                <div class="visual-circle"><i class="bi bi-calendar2-heart"></i></div>
                <div class="floating-note">
                    <i class="bi bi-check-circle-fill note-check"></i>
                    <span>Rencana hari ini<strong>Satu langkah lebih dekat</strong></span>
                </div>
            </div>
        </section>
        <section class="login-form">
            <div class="mb-4">
                <span class="form-kicker d-block mb-2">SELAMAT DATANG KEMBALI</span>
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
                    Masuk ke Dashboard <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>
            <p class="text-center small text-muted mt-4 mb-0">
                Belum punya akun? <a href="/register" class="fw-bold text-decoration-none">Daftar sekarang</a>
            </p>
        </section>
    </div>
</body>
</html>