@extends('admin.layouts.admin')

@section('title', 'Chi tiết khách hàng - Admin BARE')

@section('page-title', 'Chi tiết Khách hàng')

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
        
        .user-detail-card {
            background: white;
            border-radius: var(--bare-radius-lg);
            padding: 30px;
            box-shadow: var(--bare-shadow-card);
            margin-bottom: 30px;
        }
        
        .user-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--bare-bg);
        }
        
        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--bare-primary), var(--bare-primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 32px;
        }
        
        .user-info h2 {
            margin: 0 0 8px 0;
            font-family: 'Poppins', sans-serif;
            color: var(--bare-primary-dark);
        }
        
        .user-info p {
            margin: 0 0 4px 0;
            color: var(--bare-text);
        }
        
        .user-info .email {
            color: var(--bare-text-muted);
        }
        
        .admin-badge {
            background: #FFEBEE;
            color: #C62828;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-top: 8px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }
        
        .info-item {
            background: var(--bare-bg);
            padding: 20px;
            border-radius: 12px;
        }
        
        .info-label {
            font-size: 12px;
            color: var(--bare-text-muted);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--bare-text);
        }
        
        .membership-badge {
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
        }
        
        .membership-member {
            background: #E3F2FD;
            color: #1976D2;
        }
        
        .membership-silver {
            background: #F5F5F5;
            color: #616161;
        }
        
        .membership-gold {
            background: #FFF8E1;
            color: #FFA000;
        }
        
        .membership-platinum {
            background: #F3E5F5;
            color: #7B1FA2;
        }
        
        .edit-form {
            background: white;
            border-radius: var(--bare-radius-lg);
            padding: 30px;
            box-shadow: var(--bare-shadow-card);
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
        
        .success-message {
            background: rgba(189, 72, 35, 0.1);
            color: #bd4823;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #bd4823;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Admin Header -->
        <div class="page-header">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <h1>Chi tiết khách hàng</h1>
                <p>Xem và chỉnh sửa thông tin khách hàng</p>
            </div>
        </div>
        
        <!-- User Detail Card -->
        <div class="user-detail-card">
            <div class="user-header">
                <div class="user-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="user-info">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    @if($user->phone)
                        <p>📱 {{ $user->phone }}</p>
                    @endif
                    @if($user->is_admin)
                        <span class="admin-badge">ADMINISTRATOR</span>
                    @endif
                </div>
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">ID Khách hàng</div>
                    <div class="info-value">#{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Cấp thành viên</div>
                    <div class="info-value">
                        <span class="membership-badge membership-{{ strtolower($user->membership_level ?? 'member') }}">
                            {{ $user->membership_level ?? 'Member' }}
                        </span>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Điểm tích lũy</div>
                    <div class="info-value">{{ number_format($user->points ?? 0) }} điểm</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Ngày đăng ký</div>
                    <div class="info-value">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>
        </div>
        
        <!-- Edit Form -->
        <div class="edit-form">
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            
            <h3 style="margin-bottom: 24px; color: var(--bare-primary-dark);">Cập nhật thông tin thành viên</h3>
            
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label" for="membership_level">Cấp thành viên</label>
                    <select name="membership_level" id="membership_level" class="form-select">
                        <option value="Member" {{ ($user->membership_level ?? 'Member') == 'Member' ? 'selected' : '' }}>
                            Member
                        </option>
                        <option value="Silver" {{ ($user->membership_level ?? 'Member') == 'Silver' ? 'selected' : '' }}>
                            Silver
                        </option>
                        <option value="Gold" {{ ($user->membership_level ?? 'Member') == 'Gold' ? 'selected' : '' }}>
                            Gold
                        </option>
                        <option value="Platinum" {{ ($user->membership_level ?? 'Member') == 'Platinum' ? 'selected' : '' }}>
                            Platinum
                        </option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="points">Điểm tích lũy</label>
                    <input type="number" name="points" id="points" class="form-control" 
                           value="{{ $user->points ?? 0 }}" min="0" step="1">
                </div>
                
                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">
                        💾 Lưu thay đổi
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                        ← Quay lại danh sách
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
