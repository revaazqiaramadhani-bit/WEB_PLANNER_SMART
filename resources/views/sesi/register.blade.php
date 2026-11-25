<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Smart Planner</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #786bd6;
            --primary-dark: #6558bf;
            --ink: #35344a;
            --muted: #858395;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 28px 16px;
            display: grid;
            place-items: center;
            color: var(--ink);
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at 12% 18%, rgba(224, 218, 255, .8), transparent 24rem),
                radial-gradient(circle at 88% 82%, rgba(255, 226, 214, .72), transparent 25rem),
                #faf9fc;
        }

        .register-shell {
            width: min(940px, 100%);
            display: grid;
            grid-template-columns: .85fr 1.15fr;
            overflow: hidden;
            background: #fff;
            border: 1px solid #eeedf4;
            border-radius: 28px;
            box-shadow: 0 28px 80px rgba(72, 65, 111, .12);
        }

        .register-intro {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 600px;
            padding: 40px;
            background: linear-gradient(145deg, #e8e4ff 0%, #f5eaff 52%, #ffebe3 100%);
        }

        .brand-lockup {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 15px;
            color: #fff;
            background: linear-gradient(135deg, #a89ce9, var(--primary));
            box-shadow: 0 9px 20px rgba(120, 107, 214, .24);
        }

        .brand-caption {
            display: block;
            margin-top: 2px;
            color: #77738c;
            font-size: .68rem;
            letter-spacing: .12em;
        }

        .intro-copy h1 {
            margin: 14px 0 12px;
            font-size: clamp(2rem, 3.2vw, 2.5rem);
            line-height: 1.18;
            letter-spacing: -.045em;
        }

        .intro-copy p {
            color: #706e83;
            line-height: 1.75;
        }

        .intro-note {
            padding: 15px 17px;
            border: 1px solid rgba(255, 255, 255, .8);
            border-radius: 16px;
            background: rgba(255, 255, 255, .72);
            color: #706e83;
            font-size: .85rem;
        }

        .register-form {
            align-self: center;
            padding: 48px 56px;
        }

        .form-kicker {
            color: var(--primary-dark);
            font-size: .7rem;
            font-weight: 800;
            letter-spacing: .12em;
        }

        .register-form h2 { letter-spacing: -.035em; }
        .register-form .text-muted { color: var(--muted) !important; }
        .register-form .form-label { color: #504f62; }

        .form-control {
            min-height: 48px;
            border: 1px solid #e8e6ef;
            border-radius: 12px;
            color: var(--ink);
        }

        .form-control:focus {
            border-color: #b8afea;
            box-shadow: 0 0 0 .22rem rgba(120, 107, 214, .12);
        }

        .form-control::placeholder { color: #aaa8b7; }

        .btn-primary {
            min-height: 49px;
            border: 0;
            border-radius: 13px;
            background: var(--primary);
            font-weight: 700;
            box-shadow: 0 9px 18px rgba(120, 107, 214, .19);
        }

        .btn-primary:hover { background: var(--primary-dark); }
        a { color: var(--primary-dark); }

        @media (max-width: 700px) {
            .register-shell { grid-template-columns: 1fr; }
            .register-intro { min-height: auto; gap: 28px; padding: 28px; }
            .register-form { padding: 36px 30px 40px; }
            .intro-copy h1 { font-size: 1.9rem; }
        }

        @media (max-width: 420px) {
            .register-shell { border-radius: 22px; }
            .register-intro, .register-form { padding-left: 24px; padding-right: 24px; }
        }
    </style>
</head>
<body>
    <main class="register-shell">
        <section class="register-intro">
            <div class="brand-lockup">
                <span class="brand-icon"><i class="bi bi-calendar2-check-fill fs-4"></i></span>
                <span>Smart Planner<small class="brand-caption">PLAN WITH EASE</small></span>
            </div>
            <div class="intro-copy">
                <span class="form-kicker"><i class="bi bi-stars me-1"></i> MULAI LANGKAH BARUMU</span>
                <h1 class="fw-bold">Rencanakan hari, mulai dari sini.</h1>
                <p class="mb-0">Buat akun untuk menyimpan dan mengatur kegiatanmu dengan lebih mudah.</p>
            </div>
            <div class="intro-note">
                <i class="bi bi-heart-fill me-2" style="color:#d98e9a"></i>
                Sedikit demi sedikit, rencanamu jadi lebih teratur.
            </div>
        </section>

        <section class="register-form">
            <div class="mb-4">
                <span class="form-kicker d-block mb-2">BUAT AKUN BARU</span>
                <h2 class="h4 fw-bold mb-2">Daftar Smart Planner</h2>
                <p class="text-muted mb-0">Isi data berikut untuk mulai menggunakan aplikasi.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger border-0 small" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label small fw-bold">Nama</label>
                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required maxlength="255" autocomplete="name" placeholder="Nama lengkap">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label small fw-bold">Email</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required maxlength="255" autocomplete="email" placeholder="nama@email.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label small fw-bold">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required minlength="8" autocomplete="new-password" placeholder="Minimal 8 karakter">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label small fw-bold">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required minlength="8" autocomplete="new-password" placeholder="Ulangi password">
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    Buat Akun <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>

            <p class="text-center small text-muted mt-4 mb-0">
                Sudah punya akun? <a href="/login" class="fw-bold text-decoration-none">Masuk di sini</a>
            </p>
        </section>
    </main>
</body>
</html>
