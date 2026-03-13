<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard - BARE')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Tông cam chủ đạo */
            --bare-primary: #bd4823;
            --bare-primary-dark: #a63d1e;
            --bare-primary-light: #d45d3d;
            --bare-accent: #bd4823;
            /* Màu nền và text */
            --bare-bg: #fff3f0;
            --bare-bg-alt: #ffe0da;
            --bare-text: #4A3426;
            --bare-text-muted: #8D6E63;
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
            background: linear-gradient(180deg, var(--bare-bg) 0%, #fffbf9 40%, #ffffff 100%);
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4 {
            font-family: 'Poppins', system-ui, sans-serif;
            letter-spacing: -0.2px;
        }

        a, button {
            transition: all 0.2s ease;
        }

        .admin-content .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .admin-content .admin-nav,
        .admin-content .products-table,
        .admin-content .form-container,
        .admin-content .user-detail-card,
        .admin-content .categories-grid .category-card,
        .admin-content .orders-table,
        .admin-content .card {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(189, 72, 35, 0.12);
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.06);
        }

        .admin-content .admin-nav-link,
        .admin-content .btn,
        .admin-content .btn-sm {
            transition: all 0.2s ease;
        }

        .admin-content .admin-nav-link:hover,
        .admin-content .btn:hover,
        .admin-content .btn-sm:hover {
            transform: translateY(-1px);
        }
        
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        
        .admin-sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--bare-primary) 0%, var(--bare-primary-dark) 100%);
            color: #FFFFFF;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 4px 0 20px rgba(189, 72, 35, 0.2);
        }
        
        .admin-logo {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }
        .admin-logo img {
            height: 40px;
            margin-bottom: 8px;
            border-radius: 8px;
        }
        .admin-logo h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #FFFFFF;
        }
        .admin-logo h2 span {
            display: block;
            font-size: 12px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
        }
        
        .admin-nav {
            padding: 0 20px;
            flex: 1;
            overflow-y: auto;
        }
        
        .nav-section {
            margin-bottom: 30px;
        }
        
        .nav-title {
            font-size: 10px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: pre-line;
        }
        
        .nav-item {
            display: block;
            padding: 14px 18px;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 14px;
        }
        
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(4px);
        }
        
        .nav-item.active {
            background: rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
        }
        
        .nav-icon {
            margin-right: 10px;
            font-size: 16px;
        }
        
        .admin-main {
            margin-left: 260px;
            flex: 1;
            background: var(--bare-bg);
            min-height: 100vh;
        }
        
        .admin-header {
            background: rgba(255, 255, 255, 0.82);
            padding: 20px 30px;
            border-bottom: 1px solid rgba(189, 72, 35, 0.12);
            box-shadow: 0 2px 10px rgba(189, 72, 35, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .admin-header h1 {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--bare-primary-dark);
            margin-bottom: 4px;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
            float: right;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--bare-primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .user-info {
            text-align: right;
        }
        
        .user-name {
            font-weight: 600;
            color: var(--bare-text);
            font-size: 14px;
        }
        
        .user-role {
            font-size: 12px;
            color: var(--bare-text-muted);
        }
        
        .admin-content {
            padding: 30px;
        }

        .admin-content {
            background: linear-gradient(180deg, rgba(255, 243, 240, 0.55) 0%, rgba(255, 255, 255, 0.2) 100%);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--bare-primary), var(--bare-primary-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(189, 72, 35, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--bare-primary-dark), var(--bare-primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(189, 72, 35, 0.4);
        }
        
        .btn-outline {
            background: white;
            color: var(--bare-primary);
            border: 2px solid var(--bare-primary);
        }
        
        .btn-outline:hover {
            background: var(--bare-primary);
            color: white;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #F44336, #D32F2F);
            color: white;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #D32F2F, #B71C1C);
        }
        
        .logout-btn {
            margin: 10px 20px 0;
            width: calc(100% - 40px);
            justify-content: center;
        }
        
        .card {
            background: var(--bare-card);
            border-radius: var(--bare-radius-lg);
            padding: 24px;
            box-shadow: var(--bare-shadow-card);
            border: 1px solid var(--bare-bg-alt);
            margin-bottom: 24px;
        }
        
        .card-header {
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--bare-bg-alt);
        }
        
        .card-title {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--bare-primary-dark);
            margin-bottom: 4px;
        }
        
        .card-subtitle {
            font-size: 13px;
            color: var(--bare-text-muted);
        }
        
        .field {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s ease;
        }
        
        .field:focus {
            outline: none;
            border-color: var(--bare-primary);
            box-shadow: 0 0 0 3px rgba(189, 72, 35, 0.1);
        }
        
        .field.select {
            background: white;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 200px;
            }
            
            .admin-main {
                margin-left: 200px;
            }
        }
        
        @media (max-width: 640px) {
            .admin-sidebar {
                width: 60px;
            }
            
            .admin-main {
                margin-left: 60px;
            }
            
            .admin-logo h2 span,
            .nav-title,
            .nav-item span {
                display: none;
            }
            
            .nav-item {
                text-align: center;
                padding: 14px 8px;
            }
            
            .nav-icon {
                margin: 0;
                font-size: 20px;
            }
            
            .admin-content {
                padding: 20px;
            }
        }
    </style>

    @yield('head')
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <div class="admin-logo">
                <img src="{{ asset('image/bare-logo.png') }}" alt="bare-logo.png">
                <h2>BARE <span>Admin</span></h2>
            </div>
            
            <nav class="admin-nav">
                <div class="nav-section">
                    <div class="nav-title">Tổng quan</div>
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon">📊</span>
                        <span>Dashboard</span>
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-title">Quản lý</div>
                    <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <span class="nav-icon">🍲</span>
                        <span>Sản phẩm</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <span class="nav-icon">🏷️</span>
                        <span>Danh mục</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <span class="nav-icon">📦</span>
                        <span>Đơn hàng</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <span class="nav-icon">👥</span>
                        <span>Khách hàng</span>
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-title">Hệ thống</div>
                    <a href="{{ route('home') }}" class="nav-item" target="_blank">
                        <span class="nav-icon">🏠</span>
                        <span>Xem trang chủ</span>
                    </a>
                </div>
            </nav>
            
            <a href="{{ route('logout') }}" class="btn btn-danger logout-btn" onclick="return confirm('Bạn có chắc muốn đăng xuất?')">
                <span>🚪</span>
                <span>Đăng xuất</span>
            </a>
        </div>
        
        <!-- Main Content -->
        <div class="admin-main">
            <!-- Header -->
            <div class="admin-header">
                <h1>@yield('page-title', 'Admin Dashboard')</h1>
                <div class="admin-user">
                    <div class="user-avatar">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=bd4823&color=fff&size=128" alt="{{ auth()->user()->name }}">
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">{{ auth()->user()->role_label }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="admin-content">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
