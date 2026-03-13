@extends('admin.layouts.admin')

@section('title', ($category->exists ? 'Cập nhật danh mục - Admin BARE' : 'Thêm danh mục mới - Admin BARE'))

@section('page-title', ($category->exists ? 'Cập nhật Danh mục' : 'Thêm Danh mục'))

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

        .form-container {
            background: white;
            border-radius: var(--bare-radius-lg);
            padding: 30px;
            box-shadow: var(--bare-shadow-card);
            max-width: 900px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--bare-text);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--bare-primary);
            box-shadow: 0 0 0 3px rgba(189, 72, 35, 0.10);
        }

        .help-text {
            display: block;
            margin-top: 6px;
            color: var(--bare-text-muted);
            font-size: 12px;
        }

        .checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--bare-primary);
        }

        .error-message {
            color: #C62828;
            font-size: 12px;
            margin-top: 6px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--bare-primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--bare-primary-dark);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: white;
            color: var(--bare-text);
            border: 1px solid #E0E0E0;
        }

        .btn-secondary:hover {
            background: var(--bare-bg);
            transform: translateY(-1px);
        }

        .textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-span-2 {
            grid-column: span 2;
        }

        @media (max-width: 768px) {
            .form-span-2 {
                grid-column: span 1;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h1>{{ $category->exists ? 'Cập nhật danh mục' : 'Thêm danh mục mới' }}</h1>
                <p>{{ $category->exists ? 'Chỉnh sửa thông tin danh mục sản phẩm' : 'Tạo danh mục để tổ chức sản phẩm' }}</p>
            </div>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
                @csrf
                @if($category->exists)
                    @method('PUT')
                @endif

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="name">Tên danh mục</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="slug">Slug</label>
                        <input id="slug" name="slug" type="text" class="form-control" value="{{ old('slug', $category->slug) }}" required>
                        <span class="help-text">Ví dụ: mon-chinh, salad, nuoc-uong</span>
                        @error('slug')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-span-2">
                        <label class="form-label" for="description">Mô tả</label>
                        <textarea id="description" name="description" class="form-control textarea" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="sort_order">Thứ tự hiển thị</label>
                        <input id="sort_order" name="sort_order" type="number" min="0" class="form-control" value="{{ old('sort_order', $category->sort_order) }}">
                        <span class="help-text">Số nhỏ hơn sẽ hiển thị trước</span>
                        @error('sort_order')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Trạng thái</label>
                        <input type="hidden" name="is_active" value="0">
                        <label class="checkbox-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                            Hoạt động
                        </label>
                        @error('is_active')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">
                        {{ $category->exists ? 'Lưu thay đổi' : 'Tạo danh mục' }}
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
