@extends('admin.layouts.admin')

@section('title', 'Quản lý Đơn hàng - Admin BARE')
@section('page-title', 'Quản lý Đơn hàng')

@section('content')
    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- Stats Cards -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
            <!-- Total Orders -->
            <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border-left: 4px solid #bd4823;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(189, 72, 35, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        📦
                    </div>
                    <div style="font-size: 12px; color: #bd4823; font-weight: 600;">Tổng</div>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2d3748; margin-bottom: 4px;">{{ $totalOrders ?? $orders->total() }}</div>
                <div style="font-size: 13px; color: #718096;">Đơn hàng</div>
            </div>

            <!-- Pending Orders -->
            <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border-left: 4px solid #bd4823;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(189, 72, 35, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        ⏳
                    </div>
                    <div style="font-size: 12px; color: #bd4823; font-weight: 600;">Chờ xác nhận</div>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2d3748; margin-bottom: 4px;">{{ $pendingOrders ?? 0 }}</div>
                <div style="font-size: 13px; color: #718096;">Đơn hàng</div>
            </div>

            <!-- Preparing Orders -->
            <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border-left: 4px solid #bd4823;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(189, 72, 35, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        🔄
                    </div>
                    <div style="font-size: 12px; color: #bd4823; font-weight: 600;">Đang chuẩn bị</div>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2d3748; margin-bottom: 4px;">{{ $preparingOrders ?? 0 }}</div>
                <div style="font-size: 13px; color: #718096;">Đơn hàng</div>
            </div>

            <!-- Completed Orders -->
            <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border-left: 4px solid #bd4823;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(189, 72, 35, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        ✅
                    </div>
                    <div style="font-size: 12px; color: #bd4823; font-weight: 600;">Hoàn thành</div>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2d3748; margin-bottom: 4px;">{{ $completedOrders ?? 0 }}</div>
                <div style="font-size: 13px; color: #718096;">Đơn hàng</div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); margin-bottom: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <div style="font-size: 16px; font-weight: 600; color: #2d3748; margin-bottom: 4px;">Bộ lọc đơn hàng</div>
                    <div style="font-size: 13px; color: #718096;">Tìm kiếm và lọc theo trạng thái</div>
                </div>
                <a href="{{ route('admin.dashboard') }}" style="color: #bd4823; text-decoration: none; font-size: 13px; font-weight: 500;">← Quay lại dashboard</a>
            </div>
            
            <form method="GET" action="{{ route('admin.orders.index') }}" style="display: flex; gap: 16px; align-items: end; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; font-size: 13px; font-weight: 500; color: #4a5568; margin-bottom: 6px;">Tìm kiếm</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Mã đơn hàng, khách hàng..." 
                           style="width: 100%; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 14px;">
                </div>
                
                <div style="min-width: 150px;">
                    <label style="display: block; font-size: 13px; font-weight: 500; color: #4a5568; margin-bottom: 6px;">Trạng thái</label>
                    <select name="status" style="width: 100%; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 14px;">
                        <option value="">Tất cả</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                        <option value="preparing" {{ request('status') == 'preparing' ? 'selected' : '' }}>Đang chuẩn bị</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>

                <div style="min-width: 150px;">
                    <label style="display: block; font-size: 13px; font-weight: 500; color: #4a5568; margin-bottom: 6px;">Từ ngày</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" style="width: 100%; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 14px;">
                </div>

                <div style="min-width: 150px;">
                    <label style="display: block; font-size: 13px; font-weight: 500; color: #4a5568; margin-bottom: 6px;">Đến ngày</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" style="width: 100%; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 14px;">
                </div>
                
                <div style="min-width: 150px;">
                    <label style="display: block; font-size: 13px; font-weight: 500; color: #4a5568; margin-bottom: 6px;">Sắp xếp</label>
                    <select name="sort" style="width: 100%; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 14px;">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                        <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Giá cao nhất</option>
                        <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Giá thấp nhất</option>
                    </select>
                </div>
                
                <button type="submit" style="padding: 8px 16px; background: #bd4823; color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer; transition: all 0.2s ease;"
                        onmouseover="this.style.background='#a63d1e'" 
                        onmouseout="this.style.background='#bd4823'">
                    🔍 Tìm kiếm
                </button>

                <a href="{{ route('admin.orders.index') }}" style="padding: 8px 16px; background: #f8fafc; color: #4a5568; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none; display: inline-block; transition: all 0.2s ease;"
                   onmouseover="this.style.background='#e2e8f0'" 
                   onmouseout="this.style.background='#f8fafc'">
                    ↻ Reset
                </a>
            </form>
        </div>

        <!-- Orders Table -->
        <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <div style="font-size: 16px; font-weight: 600; color: #2d3748; margin-bottom: 4px;">Danh sách đơn hàng</div>
                    <div style="font-size: 13px; color: #718096;">{{ $orders->total() }} đơn hàng</div>
                </div>
                <div style="display: flex; gap: 12px;">
                    <button onclick="window.print()" style="padding: 8px 16px; background: #f8fafc; color: #4a5568; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; cursor: pointer; transition: all 0.2s ease;"
                            onmouseover="this.style.background='#e2e8f0'" 
                            onmouseout="this.style.background='#f8fafc'">
                        🖨️ In
                    </button>
                </div>
            </div>
            
            @if($orders->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <th style="text-align: left; padding: 12px; font-weight: 600; color: #4a5568; font-size: 12px;">MÃ ĐƠN</th>
                                <th style="text-align: left; padding: 12px; font-weight: 600; color: #4a5568; font-size: 12px;">KHÁCH HÀNG</th>
                                <th style="text-align: left; padding: 12px; font-weight: 600; color: #4a5568; font-size: 12px;">SẢN PHẨM</th>
                                <th style="text-align: left; padding: 12px; font-weight: 600; color: #4a5568; font-size: 12px;">TỔNG TIỀN</th>
                                <th style="text-align: left; padding: 12px; font-weight: 600; color: #4a5568; font-size: 12px;">TRẠNG THÁI</th>
                                <th style="text-align: left; padding: 12px; font-weight: 600; color: #4a5568; font-size: 12px;">NGÀY ĐẶT</th>
                                <th style="text-align: center; padding: 12px; font-weight: 600; color: #4a5568; font-size: 12px;">THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr style="border-bottom: 1px solid #f7fafc; transition: all 0.2s ease;"
                                    onmouseover="this.style.background='#f8fafc'" 
                                    onmouseout="this.style.background='white'">
                                    <td style="padding: 16px 12px;">
                                        <div style="font-weight: 600; color: #2d3748; font-size: 13px;">#{{ $order->code }}</div>
                                        <div style="font-size: 11px; color: #718096;">{{ $order->created_at->format('H:i') }}</div>
                                    </td>
                                    <td style="padding: 16px 12px;">
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div style="width: 32px; height: 32px; background: rgba(189, 72, 35, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; color: #bd4823;">
                                                {{ strtoupper(substr($order->user->name ?? ($order->customer_name ?? 'K'), 0, 1)) }}
                                            </div>
                                            <div>
                                                <div style="color: #4a5568; font-size: 13px; font-weight: 500;">{{ $order->user->name ?? ($order->customer_name ?? 'Khách vãng lai') }}</div>
                                                <div style="font-size: 11px; color: #718096;">{{ $order->user->email ?? ($order->customer_email ?? 'N/A') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 16px 12px;">
                                        <div style="color: #4a5568; font-size: 13px;">{{ $order->items->count() }} sản phẩm</div>
                                        @if($order->items->count() > 0)
                                            <div style="font-size: 11px; color: #718096;">{{ $order->items->first()->product->name ?? 'N/A' }}</div>
                                        @endif
                                    </td>
                                    <td style="padding: 16px 12px;">
                                        <div style="font-weight: 600; color: #bd4823; font-size: 13px;">{{ number_format($order->total ?? 0, 0, ',', '.') }}đ</div>
                                    </td>
                                    <td style="padding: 16px 12px;">
                                        @switch($order->status)
                                            @case('pending')
                                                <span style="padding: 4px 12px; background: #fff3f0; color: #bd4823; border-radius: 12px; font-size: 11px; font-weight: 500;">Chờ xác nhận</span>
                                                @break
                                            @case('confirmed')
                                                <span style="padding: 4px 12px; background: #fff3f0; color: #bd4823; border-radius: 12px; font-size: 11px; font-weight: 500;">Đã xác nhận</span>
                                                @break
                                            @case('preparing')
                                                <span style="padding: 4px 12px; background: #fff3f0; color: #bd4823; border-radius: 12px; font-size: 11px; font-weight: 500;">Đang chuẩn bị</span>
                                                @break
                                            @case('completed')
                                                <span style="padding: 4px 12px; background: #fff3f0; color: #bd4823; border-radius: 12px; font-size: 11px; font-weight: 500;">Hoàn thành</span>
                                                @break
                                            @case('cancelled')
                                                <span style="padding: 4px 12px; background: #FEE2E2; color: #DC2626; border-radius: 12px; font-size: 11px; font-weight: 500;">Đã hủy</span>
                                                @break
                                            @default
                                                <span style="padding: 4px 12px; background: #F3F4F6; color: #6B7280; border-radius: 12px; font-size: 11px; font-weight: 500;">{{ $order->status }}</span>
                                        @endswitch
                                    </td>
                                    <td style="padding: 16px 12px;">
                                        <div style="color: #4a5568; font-size: 13px;">{{ $order->created_at->format('d/m/Y') }}</div>
                                        <div style="font-size: 11px; color: #718096;">{{ $order->created_at->format('H:i') }}</div>
                                    </td>
                                    <td style="padding: 16px 12px;">
                                        <div style="display: flex; gap: 8px; justify-content: center;">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                                               style="padding: 6px 10px; background: #fff3f0; color: #bd4823; border: none; border-radius: 6px; font-size: 11px; text-decoration: none; cursor: pointer; transition: all 0.2s ease;"
                                               onmouseover="this.style.background='#ffe0da'" 
                                               onmouseout="this.style.background='#fff3f0'">
                                                👁️ Xem
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($orders->hasPages())
                    <div style="margin-top: 20px; display: flex; justify-content: center;">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
                <div style="text-align: center; padding: 60px 20px;">
                    <div style="font-size: 48px; margin-bottom: 16px;">📦</div>
                    <div style="font-size: 16px; font-weight: 600; color: #2d3748; margin-bottom: 8px;">Chưa có đơn hàng</div>
                    <div style="font-size: 13px; color: #718096;">Chưa có đơn hàng nào phù hợp với bộ lọc.</div>
                </div>
            @endif
        </div>
    </div>
@endsection
