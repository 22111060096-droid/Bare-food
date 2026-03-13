@extends('layouts.app')

@section('title', 'Đăng nhập - BARE')

@section('content')
    <h1 style="font-family:'Poppins',system-ui,sans-serif;font-size:22px;font-weight:600;color:#1B4332;margin-bottom:8px;">
        Đăng nhập tài khoản
    </h1>

    <div style="max-width:420px;background:#FFFFFF;border-radius:18px;padding:16px 18px 18px;box-shadow:0 14px 30px rgba(0,0,0,0.06);font-size:13px;">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div style="margin-bottom:8px;">
                <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="field" required autofocus>
                @error('email')
                <div style="font-size:11px;color:#C62828;margin-top:2px;">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom:8px;">
                <label style="font-size:12px;color:#9E9E9E;display:block;margin-bottom:3px;">Mật khẩu</label>
                <input type="password" name="password" class="field" required>
            </div>
            <div style="margin-bottom:8px;font-size:12px;">
                <label>
                    <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
                </label>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                Đăng nhập
            </button>
        </form>

        <div style="margin-top:10px;font-size:12px;color:#616161;">
            Chưa có tài khoản?
            <a href="{{ route('register') }}" style="color:#2E7D32;text-decoration:underline;">Đăng ký ngay</a>
        </div>
    </div>
@endsection

