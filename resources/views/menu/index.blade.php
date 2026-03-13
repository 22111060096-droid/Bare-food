@extends('layouts.app')

@section('title', 'Menu BARE - Healthy Bowls')

@section('head')
    <style>
        .menu-layout {
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
            gap: 24px;
        }
        .menu-filters {
            background: var(--bare-card);
            border-radius: 24px;
            padding: 18px 18px 20px;
            box-shadow: var(--bare-shadow-card);
            border: 3px solid var(--bare-primary);
        }
        .menu-products-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }
        .filter-group {
            margin-bottom: 12px;
        }
        .filter-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--bare-primary-dark);
            margin-bottom: 4px;
        }
        .filter-chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .filter-chip input {
            display: none;
        }
        .filter-chip span {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 999px;
            border: 1px solid rgba(191, 76, 27, 0.35);
            font-size: 11px;
            cursor: pointer;
            background: #FFF7EC;
        }
        .filter-chip input:checked + span {
            border-color: var(--bare-primary-dark);
            background: var(--bare-primary);
            color: #FFFFFF;
        }
        .menu-card {
            background: #FFFFFF;
            border-radius: 18px;
            padding: 10px 10px 9px;
            border: 2px solid #C75A2A;
            box-shadow: 0 10px 26px rgba(102, 47, 21, 0.15);
            transition: transform 0.12s ease, box-shadow 0.12s ease, border-color 0.12s ease;
        }
        .menu-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 32px rgba(102, 47, 21, 0.25);
            border-color: var(--bare-primary-dark);
        }
        .menu-tag {
            font-size: 10px;
            color: #FFFFFF;
            background: var(--bare-primary);
            padding: 3px 7px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 6px;
        }
        .menu-img {
            width: 100%;
            height: 110px;
            border-radius: 14px;
            overflow: hidden;
            background: rgba(189, 72, 35, 0.10);
            border: 1px solid rgba(189, 72, 35, 0.18);
            margin-bottom: 8px;
        }
        .menu-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .menu-title {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 3px;
            color: #3A2414;
        }
        .menu-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: #9E9E9E;
            margin-bottom: 5px;
        }
        .menu-price {
            font-size: 13px;
            font-weight: 600;
            color: var(--bare-primary);
        }
        .badge-tag {
            padding: 3px 7px;
            border-radius: 999px;
            background: #FFE3C4;
            color: var(--bare-primary-dark);
            font-size: 10px;
            font-weight: 600;
        }
        @media (max-width: 960px) {
            .menu-layout {
                grid-template-columns: minmax(0, 1fr);
            }
            .menu-products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 640px) {
            .menu-products-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }
    </style>
@endsection

@section('content')
    <div style="margin-bottom:16px;">
        <h1 style="font-family:'Poppins',system-ui,sans-serif;font-size:24px;font-weight:600;color:#1B4332;margin-bottom:4px;">
            Menu BARE
        </h1>
        <p style="font-size:13px;color:#616161;">
            Chọn bowl phù hợp với mục tiêu: giảm cân, tăng cơ hoặc giữ dáng. Tất cả đều hiển thị rõ calories &amp; dinh dưỡng.
        </p>
    </div>

    <div class="menu-layout">
        <aside class="menu-filters">
            <form method="GET" action="{{ route('menu.index') }}">
                <div class="filter-group">
                    <div class="filter-label">Danh mục</div>
                    <select name="category" class="field select" style="width:100%;">
                        <option value="">Tất cả</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" @selected(($filters['category'] ?? '') === $cat->slug)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <div class="filter-label">Mục tiêu</div>
                    <select name="goal" class="field select" style="width:100%;">
                        <option value="">Tất cả</option>
                        <option value="giảm cân" @selected(($filters['goal'] ?? '') === 'giảm cân')>Giảm cân</option>
                        <option value="tăng cơ" @selected(($filters['goal'] ?? '') === 'tăng cơ')>Tăng cơ</option>
                        <option value="giữ dáng" @selected(($filters['goal'] ?? '') === 'giữ dáng')>Giữ dáng</option>
                    </select>
                </div>

                <div class="filter-group">
                    <div class="filter-label">Calories / bowl</div>
                    <div class="filter-chip-row">
                        @php $cal = $filters['calories'] ?? ''; @endphp
                        <label class="filter-chip">
                            <input type="radio" name="calories" value="" @checked($cal === '')>
                            <span>Tất cả</span>
                        </label>
                        <label class="filter-chip">
                            <input type="radio" name="calories" value="under-400" @checked($cal === 'under-400')>
                            <span>&lt; 400 kcal</span>
                        </label>
                        <label class="filter-chip">
                            <input type="radio" name="calories" value="400-600" @checked($cal === '400-600')>
                            <span>400–600 kcal</span>
                        </label>
                        <label class="filter-chip">
                            <input type="radio" name="calories" value="above-600" @checked($cal === 'above-600')>
                            <span>&gt; 600 kcal</span>
                        </label>
                    </div>
                </div>

                <div class="filter-group">
                    <div class="filter-label">Ưu tiên</div>
                    <div style="display:flex;flex-direction:column;gap:4px;font-size:12px;color:#4A4A4A;">
                        <label>
                            <input type="checkbox" name="high_protein" value="1" @checked(!empty($filters['high_protein']))>
                            High protein (&ge; 20g)
                        </label>
                        <label>
                            <input type="checkbox" name="vegetarian" value="1" @checked(!empty($filters['vegetarian']))>
                            Thuần chay / nhiều rau
                        </label>
                    </div>
                </div>

                <div style="display:flex;gap:8px;margin-top:8px;">
                    <button class="btn btn-primary" type="submit" style="width:100%;justify-content:center;">
                        Lọc món
                    </button>
                    <a href="{{ route('menu.index') }}" class="btn btn-outline" style="justify-content:center;">
                        Xoá lọc
                    </a>
                </div>
            </form>
        </aside>

        <section>
            <div class="menu-products-grid">
                @forelse($products as $product)
                    <article class="menu-card">
                        <div class="menu-tag">
                            <span style="width:8px;height:8px;border-radius:999px;background:#2E7D32;"></span>
                            {{ $product->category?->name ?? 'Healthy Bowl' }}
                        </div>
                        <a href="{{ route('menu.show', $product->slug) }}" style="text-decoration:none;">
                            <div class="menu-img">
                                <img src="{{ $product->image_url ? asset($product->image_url) : asset('image/bare-logo.png') }}" alt="{{ $product->name }}">
                            </div>
                        </a>
                        <a href="{{ route('menu.show', $product->slug) }}" style="text-decoration:none;">
                            <div class="menu-title">{{ $product->name }}</div>
                        </a>
                        <div class="menu-meta">
                            <span>{{ $product->calories }} kcal · {{ $product->protein }}g protein</span>
                            <span class="menu-price">{{ number_format($product->price,0,',','.') }}đ</span>
                        </div>
                        <div class="menu-meta" style="margin-bottom:6px;">
                            <span>{{ $product->goal_tag ?: 'Cân bằng' }}</span>
                            @if($product->is_vegetarian)
                                <span class="badge-tag" style="background:rgba(46,125,50,0.08);color:#1B5E20;">Veggie</span>
                            @elseif($product->is_featured)
                                <span class="badge-tag">Best Seller</span>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('cart.add') }}" style="display:flex;gap:6px;align-items:center;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-outline" style="flex:1;justify-content:center;font-size:11px;padding-block:6px;">
                                Thêm vào giỏ
                            </button>
                            <a href="{{ route('menu.show', $product->slug) }}" class="btn btn-primary" style="flex:1;justify-content:center;font-size:11px;padding-block:6px;">
                                Tuỳ chỉnh
                            </a>
                        </form>
                    </article>
                @empty
                    <p style="font-size:13px;color:#616161;">Hiện chưa có món nào trong menu. Hãy thêm món từ trang Admin.</p>
                @endforelse
            </div>

            <div style="margin-top:14px;">
                {{ $products->links() }}
            </div>
        </section>
    </div>
@endsection

