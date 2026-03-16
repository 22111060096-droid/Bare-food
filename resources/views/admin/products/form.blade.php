@extends('admin.layouts.admin')

@section('title', ($product->exists ? 'Cập nhật sản phẩm - Admin BARE' : 'Thêm sản phẩm mới - Admin BARE'))

@section('page-title', ($product->exists ? 'Cập nhật Sản phẩm' : 'Thêm Sản phẩm'))

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

        .checkbox-group {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
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

        .btn-outline {
            background: white;
            color: var(--bare-text);
            border: 1px solid #E0E0E0;
        }

        .btn-outline:hover {
            background: var(--bare-bg);
            transform: translateY(-1px);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            border: 1px solid rgba(189, 72, 35, 0.18);
            background: rgba(189, 72, 35, 0.08);
            color: var(--bare-text);
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h1>{{ $product->exists ? 'Cập nhật sản phẩm' : 'Thêm sản phẩm mới' }}</h1>
                <p>{{ $product->exists ? 'Chỉnh sửa thông tin sản phẩm' : 'Tạo sản phẩm mới cho menu BARE' }}</p>
            </div>
        </div>

        <div class="form-container">
            @if ($errors->any())
                <div class="alert">
                    Vui lòng kiểm tra lại thông tin nhập.
                </div>
            @endif

            <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($product->exists)
                    @method('PUT')
                @endif

                <div class="form-grid">
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="name">Tên sản phẩm *</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="slug">Slug *</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $product->slug) }}" required>
                            <small class="help-text">Đường dẫn URL (ví dụ: salmon-poke-bowl)</small>
                            @error('slug')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="category_id">Danh mục</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (string) old('category_id', $product->category_id) === (string) $category->id ? 'selected' : '' }}>
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
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="image">Hình ảnh sản phẩm</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small class="help-text">Chọn ảnh từ máy (JPG/PNG/WebP). Có thể bỏ trống nếu không đổi ảnh.</small>
                            @error('image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror

                            @if($product->exists && $product->image_url)
                                <div style="margin-top: 12px;">
                                    <div style="font-size: 12px; color: var(--bare-text-muted); margin-bottom: 8px;">Ảnh hiện tại</div>
                                    <img src="{{ $product->image_src }}" alt="{{ $product->name }}" style="width: 160px; height: 120px; object-fit: cover; border-radius: 12px; border: 1px solid rgba(189, 72, 35, 0.15);">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label class="form-label" for="price">Giá (VNĐ) *</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price ?? 0) }}" min="0" required>
                            @error('price')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="sort_order">Thứ tự hiển thị</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $product->sort_order ?? 0) }}" min="0">
                            @error('sort_order')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="calories">Calories</label>
                                <input type="number" name="calories" id="calories" class="form-control" value="{{ old('calories', $product->calories ?? 0) }}" min="0">
                                @error('calories')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="protein">Protein (g)</label>
                                <input type="number" name="protein" id="protein" class="form-control" value="{{ old('protein', $product->protein ?? 0) }}" min="0">
                                @error('protein')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="carb">Carb (g)</label>
                                <input type="number" name="carb" id="carb" class="form-control" value="{{ old('carb', $product->carb ?? 0) }}" min="0">
                                @error('carb')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="fat">Fat (g)</label>
                                <input type="number" name="fat" id="fat" class="form-control" value="{{ old('fat', $product->fat ?? 0) }}" min="0">
                                @error('fat')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="fiber">Fiber (g)</label>
                                <input type="number" name="fiber" id="fiber" class="form-control" value="{{ old('fiber', $product->fiber ?? 0) }}" min="0">
                                @error('fiber')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="sugar">Sugar (g)</label>
                                <input type="number" name="sugar" id="sugar" class="form-control" value="{{ old('sugar', $product->sugar ?? 0) }}" min="0">
                                @error('sugar')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="goal_tag">Mục tiêu</label>
                            <select name="goal_tag" id="goal_tag" class="form-control">
                                <option value="">-- Không chọn --</option>
                                <option value="giảm cân" {{ old('goal_tag', $product->goal_tag) === 'giảm cân' ? 'selected' : '' }}>Giảm cân</option>
                                <option value="tăng cơ" {{ old('goal_tag', $product->goal_tag) === 'tăng cơ' ? 'selected' : '' }}>Tăng cơ</option>
                                <option value="giữ dáng" {{ old('goal_tag', $product->goal_tag) === 'giữ dáng' ? 'selected' : '' }}>Giữ dáng</option>
                            </select>
                            @error('goal_tag')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tùy chọn</label>
                            <div class="checkbox-group">
                                <input type="hidden" name="is_active" value="0">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', (int) ($product->is_active ?? 0)) ? 'checked' : '' }}>
                                    <span>Hiển thị sản phẩm</span>
                                </label>

                                <input type="hidden" name="is_featured" value="0">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', (int) ($product->is_featured ?? 0)) ? 'checked' : '' }}>
                                    <span>Sản phẩm nổi bật</span>
                                </label>

                                <input type="hidden" name="is_vegetarian" value="0">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_vegetarian" value="1" {{ old('is_vegetarian', (int) ($product->is_vegetarian ?? 0)) ? 'checked' : '' }}>
                                    <span>Chay</span>
                                </label>
                            </div>
                            @error('is_active')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            @error('is_featured')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            @error('is_vegetarian')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">
                        💾 {{ $product->exists ? 'Lưu thay đổi' : 'Tạo sản phẩm' }}
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
                        ← Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
