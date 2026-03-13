@extends('admin.layouts.admin')

@section('title', 'Quản lý danh mục - Admin BARE')

@section('page-title', 'Quản lý Danh mục')

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
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .category-card {
            background: white;
            border-radius: var(--bare-radius-lg);
            padding: 24px;
            box-shadow: var(--bare-shadow-card);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .category-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
        }
        
        .category-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        
        .category-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--bare-primary), var(--bare-primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }
        
        .category-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--bare-primary-dark);
            margin-bottom: 8px;
            font-family: 'Poppins', sans-serif;
        }
        
        .category-description {
            color: var(--bare-text-muted);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 16px;
        }
        
        .category-meta {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            font-size: 13px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .meta-label {
            color: var(--bare-text-muted);
        }
        
        .meta-value {
            font-weight: 500;
            color: var(--bare-text);
        }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }
        
        .status-active {
            background: rgba(189, 72, 35, 0.1);
            color: #bd4823;
        }
        
        .status-inactive {
            background: #FFEBEE;
            color: #C62828;
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
        
        .btn-edit {
            background: white;
            color: var(--bare-primary);
            border-color: var(--bare-primary);
        }
        
        .btn-edit:hover {
            background: var(--bare-primary);
            color: white;
        }
        
        .btn-delete {
            background: white;
            color: #C62828;
            border-color: #C62828;
        }
        
        .btn-delete:hover {
            background: #C62828;
            color: white;
        }
        
        .add-button {
            margin-bottom: 20px;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--bare-text-muted);
        }
        
        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        
        .empty-state-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--bare-text);
        }
        
        .empty-state-text {
            font-size: 14px;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Admin Header -->
        <div class="page-header">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h1>Quản lý danh mục</h1>
                <p>Tổ chức và quản lý các danh mục sản phẩm</p>
            </div>
        </div>
        
        <!-- Admin Navigation -->
        <div class="page-nav">
            <div class="admin-nav-links">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link">
                    📊 Tổng quan
                </a>
                <a href="{{ route('admin.products.index') }}" class="admin-nav-link">
                    🍲 Sản phẩm
                </a>
                <a href="{{ route('admin.categories.index') }}" class="admin-nav-link active">
                    🏷️ Danh mục
                </a>
                <a href="{{ route('admin.orders.index') }}" class="admin-nav-link">
                    📦 Đơn hàng
                </a>
                <a href="{{ route('admin.users.index') }}" class="admin-nav-link">
                    👥 Khách hàng
                </a>
            </div>
        </div>
        
        <!-- Add Category Button -->
        <div class="add-button">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                ➕ Thêm danh mục mới
            </a>
        </div>
        
        <!-- Categories Grid -->
        @forelse($categories as $category)
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            🍲
                        </div>
                        <span class="status-badge status-{{ $category->is_active ? 'active' : 'inactive' }}">
                            {{ $category->is_active ? 'Hoạt động' : 'Đừng ẩn' }}
                        </span>
                    </div>
                    
                    <h3 class="category-title">{{ $category->name }}</h3>
                    <p class="category-description">{{ $category->description }}</p>
                    
                    <div class="category-meta">
                        <div class="meta-item">
                            <span class="meta-label">Slug:</span>
                            <span class="meta-value">{{ $category->slug }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Sắp xếp:</span>
                            <span class="meta-value">{{ $category->sort_order }}</span>
                        </div>
                    </div>
                    
                    <div class="category-meta">
                        <div class="meta-item">
                            <span class="meta-label">Số sản phẩm:</span>
                            <span class="meta-value">{{ $category->products_count ?? 0 }}</span>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn-sm btn-edit">
                            ✏️ Sửa
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-delete" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                                🗑️ Xóa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">🏷️</div>
                <div class="empty-state-title">Chưa có danh mục nào</div>
                <div class="empty-state-text">Hãy tạo danh mục đầu tiên để bắt đầu tổ chức sản phẩm của bạn</div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    ➕ Thêm danh mục mới
                </a>
            </div>
        @endforelse
    </div>
@endsection
