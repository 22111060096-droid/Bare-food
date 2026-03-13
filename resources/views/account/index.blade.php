@extends('layouts.app')

@section('title', 'Tài khoản của tôi - BARE')

@section('content')
    <h1 style="font-family:'Poppins',system-ui,sans-serif;font-size:22px;font-weight:600;color:#1B4332;margin-bottom:8px;">
        Tài khoản của tôi
    </h1>

    <div style="display:grid;grid-template-columns:minmax(0,1.1fr) minmax(0,1fr);gap:24px;font-size:13px;">
        <section style="background:#FFFFFF;border-radius:18px;padding:14px 16px 14px;box-shadow:0 14px 30px rgba(0,0,0,0.06);">
            <h2 style="font-size:15px;font-weight:600;color:#1B4332;margin-bottom:6px;font-family:'Poppins',system-ui,sans-serif;">
                Thông tin cá nhân
            </h2>
            <p><strong>Tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $user->phone ?? 'Chưa cập nhật' }}</p>
            <p><strong>Cấp bậc:</strong> {{ strtoupper($user->membership_level) }}</p>
            <p><strong>Điểm tích luỹ:</strong> {{ $user->points }}</p>

            <form method="POST" action="{{ route('logout') }}" style="margin-top:10px;">
                @csrf
                <button type="submit" class="btn btn-outline">
                    Đăng xuất
                </button>
            </form>
        </section>

        <section style="background:#FFFFFF;border-radius:18px;padding:14px 16px 14px;box-shadow:0 14px 30px rgba(0,0,0,0.06);">
            <h2 style="font-size:15px;font-weight:600;color:#1B4332;margin-bottom:6px;font-family:'Poppins',system-ui,sans-serif;">
                Đơn hàng gần đây
            </h2>
            @if($orders->isEmpty())
                <p style="font-size:13px;color:#616161;">Bạn chưa có đơn hàng nào. Hãy đặt món từ <a href="{{ route('menu.index') }}" style="color:#2E7D32;text-decoration:underline;">menu</a>.</p>
            @else
                <ul style="list-style:none;padding-left:0;margin:0;">
                    @foreach($orders as $order)
                        <li style="padding:6px 0;border-bottom:1px solid rgba(224,224,224,0.8);">
                            <div>
                                <strong>Mã đơn:</strong> {{ $order->code }} ·
                                <strong>Tổng:</strong> {{ number_format($order->total,0,',','.') }}đ
                            </div>
                            <div style="font-size:12px;color:#9E9E9E;">
                                {{ $order->created_at->format('d/m/Y H:i') }} ·
                                Trạng thái: {{ $order->status }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
@endsection

