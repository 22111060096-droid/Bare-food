<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BARE - Healthy Bowls & More')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bare-bg: #F5F0E6;
            --bare-bg-alt: #FAFAFA;
            --bare-primary: #bd4823;
            --bare-primary-dark: #a63d1e;
            --bare-accent: #C62828;
            --bare-text: #4A4A4A;
            --bare-text-muted: #9E9E9E;
            --bare-card: #FFFFFF;
            --bare-radius-lg: 18px;
            --bare-radius-full: 999px;
            --bare-shadow-soft: 0 18px 45px rgba(189, 72, 35, 0.16);
            --bare-shadow-card: 0 14px 30px rgba(0, 0, 0, 0.06);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--bare-text);
            background: radial-gradient(circle at top left, #F2E9DC 0, #F5F0E6 35%, #FAFAFA 100%);
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            max-width: 100%;
            display: block;
        }

        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 20px 40px;
        }

        .header {
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(18px);
            background: rgba(245, 240, 230, 0.92);
            border-bottom: 1px solid rgba(158, 158, 158, 0.18);
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 14px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-logo-img {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            overflow: hidden;
            background: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .brand-text-title {
            font-family: 'Poppins', system-ui, sans-serif;
            font-weight: 700;
            font-size: 20px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--bare-primary-dark);
        }

        .brand-text-sub {
            font-size: 12px;
            color: var(--bare-text-muted);
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 22px;
            font-size: 14px;
        }

        .nav a {
            position: relative;
            padding-bottom: 4px;
            color: #616161;
            white-space: nowrap;
            transition: color 0.2s ease;
        }

        .nav a::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--bare-primary), var(--bare-primary-dark));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.2s ease;
        }

        .nav a:hover {
            color: var(--bare-primary-dark);
        }

        .nav a:hover::after {
            transform: scaleX(1);
        }

        .nav-cta {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            border-radius: var(--bare-radius-full);
            border: none;
            cursor: pointer;
            padding: 9px 20px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.12s ease, box-shadow 0.12s ease, background 0.12s ease, color 0.12s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--bare-primary), var(--bare-primary-dark));
            color: #FFFFFF;
            box-shadow: 0 10px 26px rgba(189, 72, 35, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(189, 72, 35, 0.42);
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.9);
            color: var(--bare-primary-dark);
            border: 1px solid rgba(189, 72, 35, 0.2);
        }

        .btn-outline:hover {
            background: #FFFFFF;
            border-color: rgba(189, 72, 35, 0.4);
            transform: translateY(-1px);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--bare-accent), #E53935);
            color: #FFFFFF;
            box-shadow: 0 12px 26px rgba(198, 40, 40, 0.35);
        }

        .btn-accent:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 32px rgba(198, 40, 40, 0.45);
        }

        .cart-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(189, 72, 35, 0.07);
            border: 1px solid rgba(189, 72, 35, 0.15);
            font-size: 12px;
        }

        .cart-pill-count {
            width: 20px;
            height: 20px;
            border-radius: 999px;
            background: #FFFFFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: var(--bare-primary-dark);
        }

        .footer {
            border-top: 1px solid rgba(158, 158, 158, 0.2);
            padding: 16px 20px 24px;
            margin-top: auto;
            background: rgba(250, 250, 250, 0.9);
            font-size: 12px;
            color: var(--bare-text-muted);
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav-toggle {
            display: none;
        }

        @media (max-width: 768px) {
            .header-inner {
                padding-inline: 16px;
            }

            .nav {
                display: none;
            }

            .nav-toggle {
                display: inline-flex;
                width: 34px;
                height: 34px;
                border-radius: 999px;
                border: 1px solid rgba(158, 158, 158, 0.45);
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.9);
            }

            .container {
                padding-inline: 16px;
            }
        }
    </style>

    @yield('head')
</head>
<body>
<div class="page">
    <header class="header">
        <div class="header-inner">
            <div class="brand">
                <div class="brand-logo-img">
                    <img src="{{ asset('image/bare-logo.png') }}" alt="bare-logo.png">
                </div>
                <div>
                    <div class="brand-text-title">BARE</div>
                    <div class="brand-text-sub">Healthy Bowls · Fresh Everyday</div>
                </div>
            </div>

            <nav class="nav" aria-label="Điều hướng chính">
                <a href="{{ route('home') }}">Trang chủ</a>
                <a href="{{ route('menu.index') }}">Menu</a>
                <a href="{{ route('calories.index') }}">Tính calories</a>
                <a href="{{ route('membership.index') }}">Membership</a>
                <a href="{{ route('static.stores') }}">Cửa hàng</a>
                <a href="{{ route('static.contact') }}">Liên hệ</a>
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif
                @endauth
            </nav>

            <div class="nav-cta">
                <div class="cart-pill">
                    <span class="cart-pill-count" id="mini-cart-count">0</span>
                    <span id="mini-cart-label">Món trong giỏ</span>
                </div>

                <a href="{{ route('cart.index') }}" class="btn btn-outline">Giỏ hàng</a>

                @auth
                    <a href="{{ route('account.index') }}" class="btn btn-primary">Tài khoản</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                @endauth

                <button class="nav-toggle" type="button" aria-label="Mở menu">
                    <span style="width:16px;height:2px;background:#4A4A4A;border-radius:999px;box-shadow:0 5px 0 #4A4A4A,0 -5px 0 #4A4A4A;"></span>
                </button>
            </div>
        </div>
    </header>

    <main class="container" role="main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-inner">
            <div>© {{ date('Y') }} BARE. All rights reserved.</div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ route('static.about') }}">Giới thiệu</a>
                <a href="{{ route('static.policy') }}">Chính sách &amp; bảo mật</a>
                <a href="{{ route('static.faq') }}">FAQ</a>
            </div>
        </div>
    </footer>
</div>

@yield('scripts')
</body>
</html>

