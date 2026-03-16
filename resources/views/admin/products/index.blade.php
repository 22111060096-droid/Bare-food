@extends('admin.layouts.admin')

@section('title', 'Quản lý sản phẩm - Admin BARE')

@section('page-title', 'Quản lý Sản phẩm')

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
        
        .products-table {
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
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--bare-primary), var(--bare-primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 12px;
            overflow: hidden;
        }
        
        .product-details h4 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--bare-text);
        }
        
        .product-details p {
            margin: 0;
            font-size: 12px;
            color: var(--bare-text-muted);
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
        
        .featured-badge {
            background: #FFF8E1;
            color: #FFA000;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .price-display {
            font-weight: 600;
            color: var(--bare-primary);
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
                <h1>Quản lý sản phẩm</h1>
                <p>Xem và quản lý tất cả sản phẩm của BARE</p>
            </div>
        </div>
        
        <!-- Admin Navigation -->
        <div class="page-nav">
            <div class="admin-nav-links">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link">
                    📊 Tổng quan
                </a>
                <a href="{{ route('admin.products.index') }}" class="admin-nav-link active">
                    🍲 Sản phẩm
                </a>
                <a href="{{ route('admin.categories.index') }}" class="admin-nav-link">
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
        
        <!-- Add Product Button -->
        <div class="add-button">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                ➕ Thêm sản phẩm mới
            </a>
        </div>

        @if(session('success'))
            <div style="background: rgba(189, 72, 35, 0.1); color: #bd4823; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px; border-left: 4px solid #bd4823;">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Products Table -->
        <div class="products-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Calories</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <div class="product-info">
                                    <div class="product-image">
                                        @if($product->image_url)
                                            <img src="{{ $product->image_src }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 24px;">🍲</div>
                                        @endif
                                    </div>
                                    <div class="product-details">
                                        <h4>{{ $product->name }}</h4>
                                        <p>{{ $product->description }}</p>
                                        @if($product->is_featured)
                                            <span class="featured-badge">⭐ Nổi bật</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $product->category?->name ?? 'N/A' }}
                            </td>
                            <td>
                                <span class="price-display">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                            </td>
                            <td>
                                {{ $product->calories }} kcal
                            </td>
                            <td>
                                <span class="status-badge status-{{ $product->is_active ? 'active' : 'inactive' }}">
                                    {{ $product->is_active ? 'Hoạt động' : 'Đừng ẩn' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn-sm btn-edit">
                                        ✏️ Sửa
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                            🗑️ Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--bare-text-muted);">
                                Chưa có sản phẩm nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <!-- Pagination -->
            @if($products->hasPages())
                <div class="pagination">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
