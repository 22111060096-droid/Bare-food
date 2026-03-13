@extends('admin.layouts.admin')

@section('title', 'Thêm sản phẩm mới - Admin BARE')

@section('page-title', 'Thêm Sản phẩm')

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
            max-width: 800px;
        }
        
        .form-group {
            margin-bottom: 20px;
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
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--bare-primary);
        }
        
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .checkbox-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--bare-primary);
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
        }
        
        .btn-outline {
            background: white;
            color: var(--bare-text);
            border: 1px solid #E0E0E0;
        }
        
        .btn-outline:hover {
            background: var(--bare-bg);
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }
        
        .error-message {
            color: #C62828;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Admin Header -->
        <div class="page-header">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h1>Thêm sản phẩm mới</h1>
                <p>Tạo sản phẩm mới cho menu BARE</p>
            </div>
        </div>
        
        <!-- Form Container -->
        <div class="form-container">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="name">Tên sản phẩm *</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="slug">Slug *</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                    <small style="color: var(--bare-text-muted);">Đường dẫn URL cho sản phẩm (ví dụ: salmon-poke-bowl)</small>
                    @error('slug')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="category_id">Danh mục *</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="price">Giá (VNĐ) *</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" min="0" required>
                        @error('price')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="sort_order">Thứ tự hiển thị</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="calories">Calories</label>
                        <input type="number" name="calories" id="calories" class="form-control" value="{{ old('calories', 0) }}" min="0">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="protein">Protein (g)</label>
                        <input type="number" name="protein" id="protein" class="form-control" value="{{ old('protein', 0) }}" min="0">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="carb">Carb (g)</label>
                        <input type="number" name="carb" id="carb" class="form-control" value="{{ old('carb', 0) }}" min="0">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="fat">Fat (g)</label>
                        <input type="number" name="fat" id="fat" class="form-control" value="{{ old('fat', 0) }}" min="0">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="fiber">Fiber (g)</label>
                        <input type="number" name="fiber" id="fiber" class="form-control" value="{{ old('fiber', 0) }}" min="0">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="sugar">Sugar (g)</label>
                        <input type="number" name="sugar" id="sugar" class="form-control" value="{{ old('sugar', 0) }}" min="0">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="goal_tag">Mục tiêu</label>
                    <select name="goal_tag" id="goal_tag" class="form-select">
                        <option value="">-- Không chọn --</option>
                        <option value="giảm cân" {{ old('goal_tag') == 'giảm cân' ? 'selected' : '' }}>Giảm cân</option>
                        <option value="tăng cơ" {{ old('goal_tag') == 'tăng cơ' ? 'selected' : '' }}>Tăng cơ</option>
                        <option value="giữ dáng" {{ old('goal_tag') == 'giữ dáng' ? 'selected' : '' }}>Giữ dáng</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="image_url">URL hình ảnh</label>
                    <input type="text" name="image_url" id="image_url" class="form-control" value="{{ old('image_url') }}">
                    <small style="color: var(--bare-text-muted);">Đường dẫn đến hình ảnh sản phẩm</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Tùy chọn</label>
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                            <span>Hiển thị sản phẩm</span>
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <span>Sản phẩm nổi bật</span>
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="is_vegetarian" value="1" {{ old('is_vegetarian') ? 'checked' : '' }}>
                            <span>Chay</span>
                        </label>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">
                        💾 Lưu sản phẩm
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
                        ← Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
