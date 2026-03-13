@extends('layouts.app')

@section('title', 'Thanh toán - BARE')

@section('content')
    <h1 style="font-family:'Poppins',system-ui,sans-serif;font-size:22px;font-weight:600;color:#1B4332;margin-bottom:8px;">
        Thông tin đặt hàng
    </h1>
    <p style="font-size:13px;color:#616161;margin-bottom:12px;">
        Điền thông tin nhận món, chọn hình thức thanh toán. Đơn sẽ được xác nhận qua SMS / email.
    </p>

    @if($errors->any())
        <div style="margin-bottom:8px;font-size:13px;color:#C62828;background:rgba(198,40,40,0.06);border-radius:10px;padding:6px 10px;">
            Vui lòng kiểm tra lại thông tin.
        </div>
    @endif

    <form method="POST" action="{{ route('checkout.submit') }}" style="display:grid;grid-template-columns:minmax(0,1.4fr) minmax(0,1fr);gap:24px;">
        @csrf
        <section style="background:#FFFFFF;border-radius:18px;padding:14px 16px 14px;box-shadow:0 14px 30px rgba(0,0,0,0.06);font-size:13px;">
            <div style="margin-bottom:8px;">
                <label style="display:block;font-size:12px;color:#9E9E9E;margin-bottom:3px;">Họ tên *</label>
                <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="field" required>
            </div>
            <div style="margin-bottom:8px;">
                <label style="display:block;font-size:12px;color:#9E9E9E;margin-bottom:3px;">Số điện thoại *</label>
                <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" class="field" required>
            </div>
            <div style="margin-bottom:8px;">
                <label style="display:block;font-size:12px;color:#9E9E9E;margin-bottom:3px;">Email</label>
                <input type="email" name="customer_email" value="{{ old('customer_email') }}" class="field">
            </div>
            <div style="margin-bottom:8px;">
                <label style="display:block;font-size:12px;color:#9E9E9E;margin-bottom:3px;">Địa chỉ (nếu giao tận nơi)</label>
                <input type="text" name="customer_address" value="{{ old('customer_address') }}" class="field">
            </div>
            <div style="margin-bottom:8px;">
                <label style="display:block;font-size:12px;color:#9E9E9E;margin-bottom:3px;">Ghi chú cho cửa hàng</label>
                <textarea name="note" rows="3" class="field" style="border-radius:12px;">{{ old('note') }}</textarea>
            </div>
        </section>

        <aside style="background:#FFFFFF;border-radius:18px;padding:14px 16px 14px;box-shadow:0 14px 30px rgba(0,0,0,0.06);font-size:13px;">
            <div style="margin-bottom:8px;">
                <div style="font-size:12px;color:#9E9E9E;margin-bottom:3px;">Hình thức dùng món</div>
                <label style="display:block;margin-bottom:4px;">
                    <input type="radio" name="dining_option" value="takeaway" {{ old('dining_option','takeaway') === 'takeaway' ? 'checked' : '' }}>
                    Mang đi
                </label>
                <label style="display:block;">
                    <input type="radio" name="dining_option" value="eat_in" {{ old('dining_option') === 'eat_in' ? 'checked' : '' }}>
                    Ăn tại cửa hàng
                </label>
            </div>

            <div style="margin-bottom:8px;">
                <div style="font-size:12px;color:#9E9E9E;margin-bottom:3px;">Phương thức thanh toán</div>
                @php $pm = old('payment_method','cod'); @endphp
                <select name="payment_method" class="field select" style="width:100%;">
                    <option value="cod" @selected($pm==='cod')>Thanh toán khi nhận món (COD)</option>
                    <option value="transfer" @selected($pm==='transfer')>Chuyển khoản ngân hàng</option>
                    <option value="momo" @selected($pm==='momo')>Ví Momo</option>
                    <option value="zalopay" @selected($pm==='zalopay')>ZaloPay</option>
                    <option value="vnpay" @selected($pm==='vnpay')>VNPay</option>
                    <option value="card" @selected($pm==='card')>Thẻ tín dụng/ghi nợ</option>
                </select>
                <div style="font-size:11px;color:#9E9E9E;margin-top:4px;">
                    Hiện tại website chưa kết nối cổng thanh toán, bạn sẽ nhận hướng dẫn thanh toán qua SMS / ghi chú.
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:12px;">
                Xác nhận đặt hàng
            </button>
            <a href="{{ route('cart.index') }}" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:6px;">
                Quay lại giỏ hàng
            </a>
        </aside>
    </form>
@endsection

