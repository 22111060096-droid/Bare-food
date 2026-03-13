@extends('admin.layouts.admin')

@section('title', 'Dashboard - Admin BARE')
@section('page-title', 'Dashboard Tổng Quan')

@section('content')
    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- Stats Cards -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
            <!-- Total Orders Card -->
            <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border-left: 4px solid #bd4823;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(189, 72, 35, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        📦
                    </div>
                    <div style="font-size: 12px; color: #bd4823; font-weight: 600;">+12.5%</div>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2d3748; margin-bottom: 4px;">{{ $todayOrders ?? 0 }}</div>
                <div style="font-size: 13px; color: #718096;">Đơn hàng hôm nay</div>
            </div>

            <!-- Revenue Card -->
            <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border-left: 4px solid #bd4823;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(189, 72, 35, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        💰
                    </div>
                    <div style="font-size: 12px; color: #bd4823; font-weight: 600;">+8.2%</div>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2d3748; margin-bottom: 4px;">{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}đ</div>
                <div style="font-size: 13px; color: #718096;">Doanh thu</div>
            </div>

            <!-- Products Card -->
            <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border-left: 4px solid #bd4823;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(189, 72, 35, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        🍲
                    </div>
                    <div style="font-size: 12px; color: #bd4823; font-weight: 600;">+5.1%</div>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2d3748; margin-bottom: 4px;">{{ $productCount ?? 0 }}</div>
                <div style="font-size: 13px; color: #718096;">Sản phẩm</div>
            </div>

            <!-- Customers Card -->
            <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border-left: 4px solid #bd4823;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(189, 72, 35, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        👥
                    </div>
                    <div style="font-size: 12px; color: #bd4823; font-weight: 600;">+15.3%</div>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2d3748; margin-bottom: 4px;">{{ $userCount ?? 0 }}</div>
                <div style="font-size: 13px; color: #718096;">Khách hàng</div>
            </div>
        </div>

        <!-- Charts and Activities -->
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px;">
            <!-- Revenue Chart -->
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <div>
                        <div style="font-size: 16px; font-weight: 600; color: #2d3748; margin-bottom: 4px;">Doanh thu</div>
                        <div style="font-size: 13px; color: #718096;">7 ngày qua</div>
                    </div>
                    <select style="padding: 6px 12px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; color: #4a5568;">
                        <option>7 ngày</option>
                        <option>30 ngày</option>
                        <option>3 tháng</option>
                    </select>
                </div>
                
                <div style="height: 200px; display: flex; align-items: end; justify-content: space-between; padding: 20px 0;">
                    @php
                        $chartMax = max(1, (int) ($maxValue ?? 0));
                    @endphp

                    @foreach(($chartData ?? []) as $data)
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div style="width: 100%; max-width: 40px; background: #bd4823; border-radius: 4px 4px 0 0; height: {{ (($data['value'] ?? 0) / $chartMax) * 160 }}px; transition: all 0.3s ease; cursor: pointer;"
                                 onmouseover="this.style.opacity='0.8'" 
                                 onmouseout="this.style.opacity='1'">
                            </div>
                            <div style="font-size: 11px; color: #718096; font-weight: 500;">{{ $data['day'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Activities -->
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);">
                <div style="margin-bottom: 20px;">
                    <div style="font-size: 16px; font-weight: 600; color: #2d3748; margin-bottom: 4px;">Hoạt động gần đây</div>
                    <div style="font-size: 13px; color: #718096;">Hôm nay</div>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    @forelse(($recentActivities ?? []) as $activity)
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <div style="width: 8px; height: 8px; background: #bd4823; border-radius: 50%; margin-top: 6px;"></div>
                            <div style="flex: 1;">
                                <div style="font-size: 13px; color: #2d3748; margin-bottom: 2px;">Đơn hàng mới #{{ $activity->code }}</div>
                                <div style="font-size: 11px; color: #718096;">{{ $activity->customer_name ?? ($activity->user->name ?? 'Khách vãng lai') }} - {{ number_format($activity->total ?? 0, 0, ',', '.') }}đ</div>
                            </div>
                            <div style="font-size: 11px; color: #718096;">{{ $activity->created_at->diffForHumans() }}</div>
                        </div>
                    @empty
                        <div style="font-size: 13px; color: #718096;">Chưa có hoạt động hôm nay.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions and Recent Orders -->
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px;">
            <!-- Quick Actions -->
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);">
                <div style="margin-bottom: 20px;">
                    <div style="font-size: 16px; font-weight: 600; color: #2d3748; margin-bottom: 4px;">Thao tác nhanh</div>
                    <div style="font-size: 13px; color: #718096;">Quản lý hệ thống</div>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="{{ route('admin.products.create') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px; text-decoration: none; transition: all 0.2s ease;"
                       onmouseover="this.style.background='#fff3f0'; this.style.borderLeft='4px solid #bd4823';" 
                       onmouseout="this.style.background='#f8fafc'; this.style.borderLeft='none'">
                        <div style="width: 36px; height: 36px; background: rgba(189, 72, 35, 0.1); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 18px;">➕</div>
                        <div style="flex: 1;">
                            <div style="font-size: 14px; font-weight: 500; color: #2d3748;">Thêm sản phẩm</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.orders.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px; text-decoration: none; transition: all 0.2s ease;"
                       onmouseover="this.style.background='#fff3f0'; this.style.borderLeft='4px solid #bd4823';" 
                       onmouseout="this.style.background='#f8fafc'; this.style.borderLeft='none'">
                        <div style="width: 36px; height: 36px; background: rgba(189, 72, 35, 0.1); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 18px;">📦</div>
                        <div style="flex: 1;">
                            <div style="font-size: 14px; font-weight: 500; color: #2d3748;">Đơn hàng</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.products.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px; text-decoration: none; transition: all 0.2s ease;"
                       onmouseover="this.style.background='#fff3f0'; this.style.borderLeft='4px solid #bd4823';" 
                       onmouseout="this.style.background='#f8fafc'; this.style.borderLeft='none'">
                        <div style="width: 36px; height: 36px; background: rgba(189, 72, 35, 0.1); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 18px;">🍲</div>
                        <div style="flex: 1;">
                            <div style="font-size: 14px; font-weight: 500; color: #2d3748;">Sản phẩm</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 8px; text-decoration: none; transition: all 0.2s ease;"
                       onmouseover="this.style.background='#fff3f0'; this.style.borderLeft='4px solid #bd4823';" 
                       onmouseout="this.style.background='#f8fafc'; this.style.borderLeft='none'">
                        <div style="width: 36px; height: 36px; background: rgba(189, 72, 35, 0.1); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 18px;">👥</div>
                        <div style="flex: 1;">
                            <div style="font-size: 14px; font-weight: 500; color: #2d3748;">Khách hàng</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div>
                        <div style="font-size: 16px; font-weight: 600; color: #2d3748; margin-bottom: 4px;">Đơn hàng gần đây</div>
                        <div style="font-size: 13px; color: #718096;">5 đơn hàng mới nhất</div>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" style="color: #bd4823; text-decoration: none; font-size: 13px; font-weight: 500;">Xem tất cả →</a>
                </div>
                
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <th style="text-align: left; padding: 8px; font-weight: 600; color: #4a5568; font-size: 12px;">MÃ ĐƠN</th>
                                <th style="text-align: left; padding: 8px; font-weight: 600; color: #4a5568; font-size: 12px;">KHÁCH HÀNG</th>
                                <th style="text-align: left; padding: 8px; font-weight: 600; color: #4a5568; font-size: 12px;">SẢN PHẨM</th>
                                <th style="text-align: left; padding: 8px; font-weight: 600; color: #4a5568; font-size: 12px;">TỔNG TIỀN</th>
                                <th style="text-align: left; padding: 8px; font-weight: 600; color: #4a5568; font-size: 12px;">TRẠNG THÁI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($recentOrders ?? []) as $order)
                                <tr style="border-bottom: 1px solid #f7fafc;">
                                    <td style="padding: 12px 8px;">
                                        <div style="font-weight: 600; color: #2d3748; font-size: 13px;">#{{ $order->code }}</div>
                                    </td>
                                    <td style="padding: 12px 8px;">
                                        <div style="color: #4a5568; font-size: 13px;">{{ $order->customer_name ?? ($order->user->name ?? 'Khách vãng lai') }}</div>
                                    </td>
                                    <td style="padding: 12px 8px;">
                                        <div style="color: #4a5568; font-size: 13px;">{{ $order->items->count() }} sản phẩm</div>
                                    </td>
                                    <td style="padding: 12px 8px;">
                                        <div style="font-weight: 600; color: #bd4823; font-size: 13px;">{{ number_format($order->total ?? 0, 0, ',', '.') }}đ</div>
                                    </td>
                                    <td style="padding: 12px 8px;">
                                        @switch($order->status)
                                            @case('pending')
                                                <span style="padding: 2px 8px; background: #fff3f0; color: #bd4823; border-radius: 12px; font-size: 11px; font-weight: 500;">Chờ xác nhận</span>
                                                @break
                                            @case('confirmed')
                                                <span style="padding: 2px 8px; background: #fff3f0; color: #bd4823; border-radius: 12px; font-size: 11px; font-weight: 500;">Đã xác nhận</span>
                                                @break
                                            @case('preparing')
                                                <span style="padding: 2px 8px; background: #fff3f0; color: #bd4823; border-radius: 12px; font-size: 11px; font-weight: 500;">Đang chuẩn bị</span>
                                                @break
                                            @case('completed')
                                                <span style="padding: 2px 8px; background: #fff3f0; color: #bd4823; border-radius: 12px; font-size: 11px; font-weight: 500;">Hoàn thành</span>
                                                @break
                                            @case('cancelled')
                                                <span style="padding: 2px 8px; background: #FEE2E2; color: #DC2626; border-radius: 12px; font-size: 11px; font-weight: 500;">Đã hủy</span>
                                                @break
                                            @default
                                                <span style="padding: 2px 8px; background: #F3F4F6; color: #6B7280; border-radius: 12px; font-size: 11px; font-weight: 500;">{{ $order->status }}</span>
                                        @endswitch
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="padding: 18px 8px; color: #718096; font-size: 13px;">Chưa có đơn hàng.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

