@extends('layouts.app')

@section('title', $product->name . ' - BARE Menu')

@section('head')
    <style>
        .product-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(0, 1fr);
            gap: 28px;
        }
        .product-hero-card {
            background:#FFFFFF;
            border-radius:22px;
            padding:18px 18px 16px;
            box-shadow:0 18px 45px rgba(28,49,36,0.12);
        }
        .product-macros {
            display:flex;
            gap:8px;
            flex-wrap:wrap;
            margin-top:10px;
            margin-bottom:10px;
        }
        .macro-pill {
            padding:4px 8px;
            border-radius:999px;
            background:rgba(232,245,233,0.9);
            font-size:11px;
            color:#2E7D32;
        }
        .nutrition-grid {
            display:grid;
            grid-template-columns:repeat(3,minmax(0,1fr));
            gap:6px;
            margin-top:10px;
        }
        .nutri-card {
            border-radius:12px;
            border:1px solid rgba(158,158,158,0.3);
            padding:6px 8px;
            font-size:11px;
        }
        .nutri-label {
            color:#9E9E9E;
        }
        .nutri-value {
            font-weight:600;
            color:#1B5E20;
        }
        .product-order-card {
            background:#FFFFFF;
            border-radius:18px;
            padding:14px 16px 14px;
            box-shadow:0 14px 30px rgba(0,0,0,0.06);
        }
        .toppings-list {
            max-height:220px;
            overflow:auto;
            border-radius:12px;
            border:1px solid rgba(158,158,158,0.25);
            padding:8px 10px;
            font-size:12px;
        }
        .topping-row {
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:4px 0;
            border-bottom:1px dashed rgba(224,224,224,0.8);
        }
        .topping-row:last-child {
            border-bottom:none;
        }
        .summary-row {
            display:flex;
            justify-content:space-between;
            font-size:13px;
            margin-top:10px;
        }
        @media(max-width:960px){
            .product-layout{grid-template-columns:minmax(0,1fr);}
        }
    </style>
@endsection

@section('content')
    <a href="{{ route('menu.index') }}" style="font-size:12px;color:#2E7D32;text-decoration:underline;display:inline-block;margin-bottom:8px;">
        &larr; Quay lại menu
    </a>

    <div class="product-layout">
        <section class="product-hero-card">
            <div style="font-size:12px;color:#9E9E9E;margin-bottom:4px;">
                {{ $product->category?->name ?? 'Healthy Bowl' }} · {{ $product->goal_tag ?: 'Cân bằng' }}
            </div>
            <h1 style="font-family:'Poppins',system-ui,sans-serif;font-size:22px;font-weight:600;color:#1B4332;margin-bottom:6px;">
                {{ $product->name }}
            </h1>
            <p style="font-size:13px;color:#616161;max-width:520px;margin-bottom:8px;">
                {{ $product->description }}
            </p>

            <div class="product-macros">
                <span class="macro-pill">{{ $product->calories }} kcal / bowl</span>
                <span class="macro-pill">Protein {{ $product->protein }}g</span>
                <span class="macro-pill">Carb {{ $product->carb }}g</span>
                <span class="macro-pill">Fat {{ $product->fat }}g</span>
            </div>

            <div class="nutrition-grid">
                <div class="nutri-card">
                    <div class="nutri-label">Fiber</div>
                    <div class="nutri-value">{{ $product->fiber }}g</div>
                </div>
                <div class="nutri-card">
                    <div class="nutri-label">Sugar</div>
                    <div class="nutri-value">{{ $product->sugar }}g</div>
                </div>
                <div class="nutri-card">
                    <div class="nutri-label">Giá</div>
                    <div class="nutri-value">{{ number_format($product->price,0,',','.') }}đ</div>
                </div>
            </div>

            @if($related->count())
                <div style="margin-top:16px;">
                    <div style="font-size:12px;color:#9E9E9E;margin-bottom:4px;">Gợi ý thêm cho bạn</div>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;font-size:12px;">
                        @foreach($related as $r)
                            <a href="{{ route('menu.show', $r->slug) }}" style="padding:4px 8px;border-radius:999px;border:1px solid rgba(158,158,158,0.3);background:#FFFFFF;">
                                {{ $r->name }} · {{ $r->calories }} kcal
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        <section class="product-order-card">
            <h2 style="font-size:15px;font-weight:600;color:#1B4332;margin-bottom:6px;font-family:'Poppins',system-ui,sans-serif;">
                Tuỳ chỉnh &amp; đặt món
            </h2>
            <p style="font-size:12px;color:#616161;margin-bottom:10px;">
                Bạn có thể thêm bớt topping để phù hợp khẩu vị. Giá &amp; calories sẽ cập nhật bên dưới (demo frontend).
            </p>

            <form method="POST" action="{{ route('cart.add') }}" id="product-order-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div style="margin-bottom:8px;">
                    <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Số lượng</label>
                    <input type="number" name="qty" id="order-qty" value="1" min="1" max="10" class="field" style="width:80px;">
                </div>

                <div style="margin-bottom:8px;">
                    <div style="font-size:12px;color:#9E9E9E;margin-bottom:4px;">Base (cơm / salad)</div>
                    <select id="base-select" class="field select" style="width:100%;">
                        <option value="rice" data-price="0" data-calories="0">Healthy rice base (mặc định)</option>
                        <option value="quinoa" data-price="15000" data-calories="40">Quinoa mix (+15.000đ · +40 kcal)</option>
                        <option value="salad" data-price="0" data-calories="-60">Salad base (giảm ~60 kcal)</option>
                    </select>
                </div>

                <div style="margin-bottom:8px;">
                    <div style="font-size:12px;color:#9E9E9E;margin-bottom:4px;">Topping thêm</div>
                    <div class="toppings-list" id="toppings-list">
                        <div class="topping-row">
                            <label>
                                <input type="checkbox" class="topping-input" data-price="15000" data-calories="60">
                                + Trứng lòng đào
                            </label>
                            <span style="font-size:11px;color:#616161;">+15k · +60 kcal</span>
                        </div>
                        <div class="topping-row">
                            <label>
                                <input type="checkbox" class="topping-input" data-price="20000" data-calories="80">
                                + Bơ
                            </label>
                            <span style="font-size:11px;color:#616161;">+20k · +80 kcal</span>
                        </div>
                        <div class="topping-row">
                            <label>
                                <input type="checkbox" class="topping-input" data-price="25000" data-calories="90">
                                + Thêm cá hồi
                            </label>
                            <span style="font-size:11px;color:#616161;">+25k · +90 kcal</span>
                        </div>
                        <div class="topping-row">
                            <label>
                                <input type="checkbox" class="topping-input" data-price="10000" data-calories="30">
                                + Hạt mix
                            </label>
                            <span style="font-size:11px;color:#616161;">+10k · +30 kcal</span>
                        </div>
                    </div>
                </div>

                <div class="summary-row">
                    <div>
                        <div style="font-size:12px;color:#9E9E9E;">Tổng giá (ước tính)</div>
                        <div style="font-size:18px;font-weight:600;color:#C62828;" id="summary-price">
                            {{ number_format($product->price,0,',','.') }}đ
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size:12px;color:#9E9E9E;">Tổng calories (ước tính)</div>
                        <div style="font-size:16px;font-weight:600;color:#1B5E20;" id="summary-calories">
                            {{ $product->calories }} kcal
                        </div>
                    </div>
                </div>

                <div style="margin-top:12px;display:flex;gap:8px;align-items:center;">
                    <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">
                        Thêm vào giỏ
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline" style="justify-content:center;">
                        Xem giỏ
                    </a>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            const basePrice = {{ $product->price }};
            const baseCalories = {{ $product->calories }};

            const priceEl = document.getElementById('summary-price');
            const calEl = document.getElementById('summary-calories');
            const qtyEl = document.getElementById('order-qty');
            const baseSelect = document.getElementById('base-select');

            function formatVnd(v) {
                return v.toLocaleString('vi-VN') + 'đ';
            }

            function recalc() {
                let qty = parseInt(qtyEl.value || '1', 10);
                if (isNaN(qty) || qty < 1) qty = 1;

                const baseOption = baseSelect.options[baseSelect.selectedIndex];
                const baseExtraPrice = parseInt(baseOption.getAttribute('data-price') || '0', 10);
                const baseExtraCalories = parseInt(baseOption.getAttribute('data-calories') || '0', 10);

                let toppingsExtraPrice = 0;
                let toppingsExtraCalories = 0;
                document.querySelectorAll('.topping-input').forEach(function (el) {
                    if (el.checked) {
                        toppingsExtraPrice += parseInt(el.getAttribute('data-price') || '0', 10);
                        toppingsExtraCalories += parseInt(el.getAttribute('data-calories') || '0', 10);
                    }
                });

                const perBowlPrice = basePrice + baseExtraPrice + toppingsExtraPrice;
                const perBowlCalories = baseCalories + baseExtraCalories + toppingsExtraCalories;

                const totalPrice = perBowlPrice * qty;
                const totalCalories = perBowlCalories * qty;

                if (priceEl) priceEl.textContent = formatVnd(totalPrice);
                if (calEl) calEl.textContent = totalCalories + ' kcal';
            }

            document.addEventListener('DOMContentLoaded', function () {
                qtyEl.addEventListener('input', recalc);
                baseSelect.addEventListener('change', recalc);
                document.querySelectorAll('.topping-input').forEach(function (el) {
                    el.addEventListener('change', recalc);
                });
                recalc();
            });
        })();
    </script>
@endsection

