<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Planner')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #786bd6;
            --primary-dark: #6558bf;
            --navy: #35344a;
            --surface: #ffffff;
            --background: #f8f7fb;
            --text: #35344a;
            --muted: #77768a;
            --border: #eeedf4;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(ellipse at 92% 0%, rgba(244, 220, 213, .34), transparent 28rem),
                var(--background);
            color: var(--text);
            min-height: 100vh;
        }

        .sidebar {
            width: 258px;
            min-height: 100vh;
            background: #fff;
            color: var(--text);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            border-right: 1px solid var(--border);
            box-shadow: 8px 0 30px rgba(53, 52, 74, .035);
            transition: transform .25s ease;
        }

        .sidebar-brand {
            height: 82px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text);
            border-bottom: 1px solid var(--border);
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #b9b1f3, #786bd6);
            box-shadow: 0 8px 18px rgba(120, 107, 214, .22);
        }

        .sidebar-menu { padding: 1.25rem .75rem; }

        .menu-label {
            color: #a09eae;
            font-size: .68rem;
            font-weight: 800;
            letter-spacing: .12em;
            padding: 0 .75rem;
            margin: 0 0 .5rem;
        }

        .sidebar .nav-link {
            color: #77768a;
            padding: .82rem 1rem;
            margin: .25rem 0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 11px;
            font-size: .91rem;
            font-weight: 600;
            transition: .18s ease;
        }

        .sidebar .nav-link i { font-size: 1.12rem; }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #f1effd;
            color: var(--primary-dark);
        }

        .sidebar .nav-link.active {
            box-shadow: inset 3px 0 0 #a69ce9;
        }

        .sidebar-footer {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 1rem .75rem;
            border-top: 1px solid var(--border);
        }

        .main-content {
            margin-left: 258px;
            min-height: 100vh;
            padding: 1.5rem 2rem 2.75rem;
        }

        .topbar {
            min-height: 74px;
            background: rgba(255, 255, 255, .94);
            border: 1px solid rgba(238, 237, 244, .95);
            border-radius: 20px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 30px rgba(53, 52, 74, .045);
        }

        .clock-pill {
            background: #f4f1ff;
            color: var(--primary-dark);
            border: 1px solid #e9e4fc;
            border-radius: 13px;
            padding: .55rem .8rem;
            font-size: .82rem;
        }

        .card {
            border: 1px solid var(--border) !important;
            border-radius: 20px !important;
            box-shadow: 0 12px 30px rgba(53, 52, 74, .045);
        }

        .card-header {
            border-bottom: 1px solid var(--border) !important;
            border-radius: 20px 20px 0 0 !important;
        }

        .form-control, .form-select {
            border-color: #dde4ef;
            border-radius: 10px;
            min-height: 43px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #b8afea;
            box-shadow: 0 0 0 .22rem rgba(120, 107, 214, .12);
        }

        .btn { border-radius: 10px; font-weight: 700; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .place-items-center { place-items: center; }
        .bg-primary-subtle { background-color: #f1effd !important; }
        .text-primary { color: var(--primary-dark) !important; }

        .table thead th {
            background: #fbfafd;
            color: #858395;
            font-size: .72rem;
            letter-spacing: .055em;
            border-bottom: 1px solid var(--border);
        }

        .table tbody td {
            border-color: #f1f0f5;
            padding-top: .9rem;
            padding-bottom: .9rem;
        }

        .table-hover > tbody > tr:hover > * { background: #fcfbff; }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .45);
            z-index: 1025;
        }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .main-content { margin-left: 0; padding: 1rem 1.25rem 2rem; }
        }

        @media (max-width: 575.98px) {
            .topbar { border-radius: 14px; }
            .topbar-title { font-size: 1rem; }
            .clock-pill { margin-top: .65rem; }
            .main-content { padding: .75rem .85rem 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <span class="brand-mark"><i class="bi bi-calendar2-check-fill fs-5"></i></span>
            <span>Smart Planner</span>
        </div>
        <div class="sidebar-menu">
            <p class="menu-label">MENU UTAMA</p>
            <a href="/plans" class="nav-link {{ request()->is('plans*') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>My Plans</span>
            </a>
            <a href="/categories" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i>
                <span>Kategori</span>
            </a>
        </div>
        <div class="sidebar-footer">
            <form action="/logout" method="POST">
                @csrf
                <button class="nav-link w-100 border-0 bg-transparent text-start" type="submit">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </nav>

    <main class="main-content">
        <header class="topbar d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" id="sidebarToggle" type="button" aria-label="Buka menu">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div>
                    <small class="text-muted d-block fw-semibold mb-1" id="current-date">Memuat tanggal...</small>
                    <h1 class="topbar-title h5 fw-bold mb-0">@yield('page_title', 'Dashboard Rencana')</h1>
                </div>
            </div>
            <div class="clock-pill d-none d-sm-flex align-items-center">
                <i class="bi bi-clock me-2"></i>
                <span id="current-time">00:00:00 WIB</span>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateClock() {
            const now = new Date();
            const dateString = now.toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });
            const timeString = [
                String(now.getHours()).padStart(2, '0'),
                String(now.getMinutes()).padStart(2, '0'),
                String(now.getSeconds()).padStart(2, '0')
            ].join(':') + ' WIB';

            const dateElement = document.getElementById('current-date');
            const timeElement = document.getElementById('current-time');
            if (dateElement) dateElement.textContent = dateString;
            if (timeElement) timeElement.textContent = timeString;
        }
        updateClock();
        setInterval(updateClock, 1000);

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('sidebarToggle');
        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.add('show');
                overlay.classList.add('show');
            });
        }
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>
    @stack('scripts')
</body>
</html>