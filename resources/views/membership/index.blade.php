@extends('layouts.app')

@section('title', 'Membership BARE')

@section('content')
    <h1 style="font-family:'Poppins',system-ui,sans-serif;font-size:22px;font-weight:600;color:#1B4332;margin-bottom:8px;">
        Membership &amp; tích điểm BARE
    </h1>

    <div style="display:grid;grid-template-columns:minmax(0,1.2fr) minmax(0,1fr);gap:24px;">
        <section style="background:#FFFFFF;border-radius:18px;padding:14px 16px 14px;box-shadow:0 14px 30px rgba(0,0,0,0.06);font-size:13px;">
            <p style="font-size:13px;color:#616161;margin-bottom:8px;">
                BARE Rewards giúp bạn tích điểm cho mỗi đơn hàng và nhận ưu đãi theo cấp bậc: Member &rarr; Silver &rarr; Gold &rarr; Platinum.
            </p>
            <ul style="font-size:13px;color:#4A4A4A;list-style:disc;padding-left:18px;margin-bottom:8px;">
                <li>1.000đ = 10 điểm, 100 điểm = 10.000đ giảm giá.</li>
                <li>Giảm 5% (Silver), 8% (Gold), 12% (Platinum) trên mỗi đơn.</li>
                <li>Combo độc quyền &amp; quà sinh nhật cho thành viên.</li>
            </ul>
            <p style="font-size:12px;color:#9E9E9E;">
                Điểm và cấp bậc sẽ được cập nhật dần khi bạn đặt hàng qua tài khoản trên website hoặc tại cửa hàng.
            </p>
        </section>

        <aside style="background:linear-gradient(145deg,#1B5E20,#2E7D32);border-radius:18px;padding:16px 16px 14px;color:#FFFFFF;box-shadow:0 18px 38px rgba(27,94,32,0.55);font-size:13px;">
            @if($user)
                <div style="font-size:12px;opacity:0.9;margin-bottom:4px;">Thành viên hiện tại</div>
                <div style="font-family:'Poppins',system-ui,sans-serif;font-size:18px;font-weight:600;">
                    {{ $user->name }}
                </div>
                <div style="margin-top:6px;">
                    Cấp bậc: <strong style="text-transform:uppercase;">{{ $user->membership_level }}</strong><br>
                    Điểm hiện có: <strong>{{ $user->points }}</strong>
                </div>
                <div style="margin-top:10px;font-size:12px;opacity:0.9;">
                    Mỗi đơn thành công sẽ cộng điểm tương ứng. Bạn có thể dùng điểm như voucher giảm giá cho đơn sau.
                </div>
                <a href="{{ route('account.index') }}" class="btn btn-outline" style="margin-top:10px;border-color:rgba(255,255,255,0.6);color:#FFFFFF;">
                    Xem lịch sử đơn &amp; điểm
                </a>
            @else
                <div style="font-size:13px;margin-bottom:6px;">
                    Đăng nhập hoặc đăng ký để bắt đầu tích điểm cùng BARE.
                </div>
                <div style="display:flex;gap:8px;margin-top:6px;">
                    <a href="{{ route('login') }}" class="btn btn-primary" style="flex:1;justify-content:center;">
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline" style="flex:1;justify-content:center;border-color:rgba(255,255,255,0.6);color:#FFFFFF;">
                        Đăng ký
                    </a>
                </div>
            @endif
        </aside>
    </div>
@endsection

