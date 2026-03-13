@extends('admin.layouts.admin')

@section('title', 'Quản lý khách hàng - Admin BARE')

@section('page-title', 'Quản lý Khách hàng')

@section('head')
    <style>
        .page-header {
            background: var(--bare-primary);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        
        .page-header h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .page-header p {
            opacity: 0.9;
            font-size: 14px;
        }
        
        .page-nav {
            background: white;
            border-radius: var(--bare-radius-lg);
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: var(--bare-shadow-card);
        }
        
        .admin-nav-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .admin-nav-link {
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--bare-text);
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        
        .admin-nav-link:hover {
            background: var(--bare-bg);
            color: var(--bare-primary);
        }
        
        .admin-nav-link.active {
            background: var(--bare-primary);
            color: white;
        }
        
        .users-table {
            background: white;
            border-radius: var(--bare-radius-lg);
            overflow: hidden;
            box-shadow: var(--bare-shadow-card);
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th {
            background: var(--bare-bg);
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: var(--bare-primary-dark);
            border-bottom: 2px solid #E0E0E0;
        }
        
        .table td {
            padding: 16px;
            border-bottom: 1px solid #F0F0F0;
        }
        
        .table tr:hover {
            background: #FAFAFA;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--bare-primary), var(--bare-primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }
        
        .user-details h4 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--bare-text);
        }
        
        .user-details p {
            margin: 0;
            font-size: 12px;
            color: var(--bare-text-muted);
        }
        
        .membership-badge {
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }
        
        .membership-member {
            background: #E3F2FD;
            color: #1976D2;
        }
        
        .membership-silver {
            background: #F5F5F5;
            color: #616161;
        }
        
        .membership-gold {
            background: #FFF8E1;
            color: #FFA000;
        }
        
        .membership-platinum {
            background: #F3E5F5;
            color: #7B1FA2;
        }
        
        .points-display {
            font-weight: 600;
            color: var(--bare-primary);
        }
        
        .admin-badge {
            background: #FFEBEE;
            color: #C62828;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
            text-decoration: none;
            border: 1px solid;
            transition: all 0.2s ease;
        }
        
        .btn-view {
            background: white;
            color: var(--bare-primary);
            border-color: var(--bare-primary);
        }
        
        .btn-view:hover {
            background: var(--bare-primary);
            color: white;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 20px;
        }
        
        .pagination a {
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: var(--bare-text);
            border: 1px solid #E0E0E0;
        }
        
        .pagination a:hover {
            background: var(--bare-bg);
            color: var(--bare-primary);
        }
        
        .pagination .current {
            background: var(--bare-primary);
            color: white;
            border-color: var(--bare-primary);
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Admin Header -->
        <div class="page-header">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h1>Quản lý khách hàng</h1>
                <p>Xem và quản lý thông tin tất cả khách hàng đăng ký</p>
            </div>
        </div>
        
        <!-- Admin Navigation -->
        <div class="page-nav">
            <div class="admin-nav-links">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link">
                    📊 Tổng quan
                </a>
                <a href="{{ route('admin.orders.index') }}" class="admin-nav-link">
                    📦 Đơn hàng
                </a>
                <a href="{{ route('admin.products.index') }}" class="admin-nav-link">
                    🍲 Sản phẩm
                </a>
                <a href="{{ route('admin.categories.index') }}" class="admin-nav-link">
                    🏷️ Danh mục
                </a>
                <a href="{{ route('admin.users.index') }}" class="admin-nav-link active">
                    👥 Khách hàng
                </a>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="users-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Khách hàng</th>
                        <th>Thành viên</th>
                        <th>Điểm tích lũy</th>
                        <th>Ngày đăng ký</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="user-details">
                                        <h4>{{ $user->name }}</h4>
                                        <p>{{ $user->email }}</p>
                                        @if($user->phone)
                                            <p>{{ $user->phone }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($user->is_admin)
                                    <span class="admin-badge">ADMIN</span>
                                @else
                                    <span class="membership-badge membership-{{ strtolower($user->membership_level ?? 'member') }}">
                                        {{ $user->membership_level ?? 'Member' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="points-display">{{ number_format($user->points ?? 0) }} điểm</span>
                            </td>
                            <td>
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn-sm btn-view">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: var(--bare-text-muted);">
                                Chưa có khách hàng nào đăng ký
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <!-- Pagination -->
            @if($users->hasPages())
                <div class="pagination">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
