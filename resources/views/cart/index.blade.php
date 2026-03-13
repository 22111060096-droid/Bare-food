@extends('layouts.app')

@section('title', 'Giỏ hàng - BARE')

@section('head')
    <style>
        .cart-layout {
            display:grid;
            grid-template-columns:minmax(0,1.6fr) minmax(0,1fr);
            gap:24px;
        }
        .cart-table {
            width:100%;
            border-collapse:separate;
            border-spacing:0 6px;
            font-size:13px;
        }
        .cart-row {
            background:#FFFFFF;
            border-radius:14px;
            box-shadow:0 8px 20px rgba(0,0,0,0.04);
        }
        .cart-row td {
            padding:8px 10px;
        }
        .cart-summary {
            background:#FFFFFF;
            border-radius:18px;
            padding:14px 16px 14px;
            box-shadow:0 14px 30px rgba(0,0,0,0.06);
            font-size:13px;
        }
        @media(max-width:960px){
            .cart-layout{grid-template-columns:minmax(0,1fr);}
        }
    </style>
@endsection

@section('content')
    <h1 style="font-family:'Poppins',system-ui,sans-serif;font-size:22px;font-weight:600;color:#1B4332;margin-bottom:10px;">
        Giỏ hàng của bạn
    </h1>

    @if(session('success'))
        <div style="margin-bottom:8px;font-size:13px;color:#1B5E20;background:rgba(46,125,50,0.06);border-radius:10px;padding:6px 10px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="margin-bottom:8px;font-size:13px;color:#C62828;background:rgba(198,40,40,0.06);border-radius:10px;padding:6px 10px;">
            {{ session('error') }}
        </div>
    @endif

    @if(empty($items))
        <p style="font-size:13px;color:#616161;">Giỏ hàng đang trống. Hãy chọn món từ <a href="{{ route('menu.index') }}" style="color:#2E7D32;text-decoration:underline;">menu</a>.</p>
    @else
        <div class="cart-layout">
            <section>
                <form method="POST" action="{{ route('cart.update') }}">
                    @csrf
                    <table class="cart-table">
                        <thead>
                        <tr style="font-size:12px;color:#9E9E9E;text-align:left;">
                            <th>Món</th>
                            <th>Số lượng</th>
                            <th>Calories</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $row)
                            <tr class="cart-row">
                                <td>
                                    <div style="font-weight:600;color:#1B4332;">{{ $row['product']->name }}</div>
                                    <div style="font-size:11px;color:#9E9E9E;">
                                        {{ $row['product']->category?->name ?? 'Healthy Bowl' }} · {{ $row['product']->calories }} kcal / bowl
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="items[{{ $index }}][product_id]" value="{{ $row['product']->id }}">
                                    <input type="number"
                                           name="items[{{ $index }}][qty]"
                                           value="{{ $row['qty'] }}"
                                           min="0" max="10"
                                           class="field"
                                           style="width:70px;">
                                </td>
                                <td>{{ $row['line_calories'] }} kcal</td>
                                <td>{{ number_format($row['line_total'],0,',','.') }}đ</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.remove') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $row['product']->id }}">
                                        <button type="submit" class="btn btn-outline" style="font-size:11px;padding:4px 10px;">
                                            Xoá
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div style="margin-top:10px;display:flex;gap:8px;">
                        <button type="submit" class="btn btn-outline">
                            Cập nhật giỏ hàng
                        </button>
                        <a href="{{ route('menu.index') }}" class="btn btn-primary">
                            Thêm món khác
                        </a>
                    </div>
                </form>
            </section>

            <aside class="cart-summary">
                <h2 style="font-size:15px;font-weight:600;color:#1B4332;margin-bottom:8px;font-family:'Poppins',system-ui,sans-serif;">
                    Tóm tắt đơn
                </h2>
                <div style="display:flex;justify-content:space-between;margin-bottom:4px;">
                    <span>Tạm tính</span>
                    <span>{{ number_format($subtotal,0,',','.') }}đ</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:4px;font-size:12px;color:#9E9E9E;">
                    <span>Khuyến mãi</span>
                    <span>0đ</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-top:8px;border-top:1px dashed #E0E0E0;padding-top:6px;">
                    <strong>Tổng cộng</strong>
                    <strong>{{ number_format($subtotal,0,',','.') }}đ</strong>
                </div>
                <div style="font-size:12px;color:#9E9E9E;margin-top:4px;">
                    Tổng calories ước tính: <strong>{{ $totalCalories }} kcal</strong>
                </div>

                <form method="GET" action="{{ route('checkout.form') }}" style="margin-top:12px;">
                    <button class="btn btn-primary" style="width:100%;justify-content:center;">
                        Tiến hành đặt hàng
                    </button>
                </form>
            </aside>
        </div>
    @endif
@endsection

