@extends('layouts.app')

@section('title', 'Đăng ký - BARE')

@section('content')
    <h1 style="font-family:'Poppins',system-ui,sans-serif;font-size:22px;font-weight:600;color:#1B4332;margin-bottom:8px;">
        Đăng ký thành viên BARE
    </h1>

    <div style="max-width:460px;background:#FFFFFF;border-radius:18px;padding:16px 18px 18px;box-shadow:0 14px 30px rgba(0,0,0,0.06);font-size:13px;">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div style="margin-bottom:8px;">
                <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Họ tên</label>
                <input type="text" name="name" value="{{ old('name') }}" class="field" required>
                @error('name')
                <div style="font-size:11px;color:#C62828;margin-top:2px;">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom:8px;">
                <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="field" required>
                @error('email')
                <div style="font-size:11px;color:#C62828;margin-top:2px;">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom:8px;">
                <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="field">
            </div>
            <div style="margin-bottom:8px;">
                <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Mật khẩu</label>
                <input type="password" name="password" class="field" required>
            </div>
            <div style="margin-bottom:8px;">
                <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" class="field" required>
                @error('password')
                <div style="font-size:11px;color:#C62828;margin-top:2px;">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                Đăng ký
            </button>
        </form>
        <div style="margin-top:10px;font-size:12px;color:#616161;">
            Đã có tài khoản?
            <a href="{{ route('login') }}" style="color:#2E7D32;text-decoration:underline;">Đăng nhập</a>
        </div>
    </div>
@endsection

