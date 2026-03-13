@extends('admin.layouts.admin')



@section('title', 'Chi tiết đơn hàng - Admin BARE')

@section('page-title', 'Chi tiết đơn hàng')



@section('content')

    <div style="display:flex;flex-direction:column;gap:24px;">

        <!-- Order summary -->

        <div style="background:white;border-radius:16px;padding:24px;box-shadow:var(--bare-shadow-card);">

            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;margin-bottom:16px;">

                <div>

                    <h2 style="font-size:22px;font-weight:600;color:var(--bare-primary-dark);margin-bottom:4px;">

                        Đơn hàng #{{ $order->code }}

                    </h2>

                    <div style="font-size:13px;color:var(--bare-text-muted);">

                        Tạo lúc {{ $order->created_at->format('d/m/Y H:i') }}

                    </div>

                </div>

                <div>

                    <span class="status-badge status-{{ $order->status }}">

                        {{ match($order->status) {

                            \App\Models\Order::STATUS_PENDING => 'Chờ xác nhận',

                            \App\Models\Order::STATUS_CONFIRMED => 'Đã xác nhận',

                            \App\Models\Order::STATUS_PREPARING => 'Đang chuẩn bị',

                            \App\Models\Order::STATUS_COMPLETED => 'Hoàn thành',

                            \App\Models\Order::STATUS_CANCELLED => 'Đã hủy',

                            default => $order->status

                        } }}

                    </span>

                </div>

            </div>



            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;">

                <div>

                    <h3 style="font-size:14px;font-weight:600;margin-bottom:8px;">Thông tin khách hàng</h3>

                    <p style="margin:4px 0;"><strong>Tên:</strong> {{ $order->customer_name }}</p>

                    <p style="margin:4px 0;"><strong>Điện thoại:</strong> {{ $order->customer_phone }}</p>

                    <p style="margin:4px 0;"><strong>Email:</strong> {{ $order->customer_email }}</p>

                    <p style="margin:4px 0;"><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>

                </div>

                <div>

                    <h3 style="font-size:14px;font-weight:600;margin-bottom:8px;">Thông tin đơn hàng</h3>

                    <p style="margin:4px 0;"><strong>Hình thức dùng:</strong> {{ $order->dining_option }}</p>

                    <p style="margin:4px 0;"><strong>Thanh toán:</strong> {{ $order->payment_method }}</p>

                    <p style="margin:4px 0;"><strong>Tổng calories:</strong> {{ number_format($order->total_calories ?? 0) }} kcal</p>

                    <p style="margin:4px 0;"><strong>Ghi chú:</strong> {{ $order->note ?: 'Không có' }}</p>

                </div>

                <div>

                    <h3 style="font-size:14px;font-weight:600;margin-bottom:8px;">Giá trị đơn hàng</h3>

                    <p style="margin:4px 0;"><strong>Tạm tính:</strong> {{ number_format($order->subtotal, 0, ',', '.') }}đ</p>

                    <p style="margin:4px 0;"><strong>Giảm giá:</strong> {{ number_format($order->discount_amount, 0, ',', '.') }}đ</p>

                    <p style="margin:8px 0 0;font-size:18px;font-weight:700;color:var(--bare-primary);">

                        Tổng cộng: {{ number_format($order->total, 0, ',', '.') }}đ

                    </p>

                </div>

            </div>

        </div>



        <!-- Items -->

        <div style="background:white;border-radius:16px;padding:24px;box-shadow:var(--bare-shadow-card);">

            <h3 style="font-size:16px;font-weight:600;margin-bottom:16px;">Sản phẩm trong đơn</h3>

            <table style="width:100%;border-collapse:collapse;">

                <thead>

                    <tr style="background:var(--bare-bg);">

                        <th style="padding:12px;text-align:left;">Sản phẩm</th>

                        <th style="padding:12px;text-align:center;">Số lượng</th>

                        <th style="padding:12px;text-align:right;">Đơn giá</th>

                        <th style="padding:12px;text-align:right;">Thành tiền</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($order->items as $item)

                        <tr style="border-bottom:1px solid #F0F0F0;">

                            <td style="padding:12px;">

                                <strong>{{ $item->product_name }}</strong>

                            </td>

                            <td style="padding:12px;text-align:center;">

                                {{ $item->quantity }}

                            </td>

                            <td style="padding:12px;text-align:right;">

                                {{ number_format($item->unit_price, 0, ',', '.') }}đ

                            </td>

                            <td style="padding:12px;text-align:right;">

                                {{ number_format($item->total_price, 0, ',', '.') }}đ

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>



        <!-- Update status -->

        <div style="background:white;border-radius:16px;padding:24px;box-shadow:var(--bare-shadow-card);">

            <h3 style="font-size:16px;font-weight:600;margin-bottom:12px;">Cập nhật trạng thái</h3>

            <form method="POST" action="{{ route('admin.orders.update', $order) }}" style="display:flex;flex-wrap:wrap;gap:12px;align-items:center;">

                @csrf

                @method('PUT')

                <select name="status" style="padding:10px 14px;border-radius:8px;border:1px solid #E0E0E0;min-width:180px;">

                    @foreach([\App\Models\Order::STATUS_PENDING => 'Chờ xác nhận',

                              \App\Models\Order::STATUS_CONFIRMED => 'Đã xác nhận',

                              \App\Models\Order::STATUS_PREPARING => 'Đang chuẩn bị',

                              \App\Models\Order::STATUS_COMPLETED => 'Hoàn thành',

                              \App\Models\Order::STATUS_CANCELLED => 'Đã hủy'] as $value => $label)

                        <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>

                            {{ $label }}

                        </option>

                    @endforeach

                </select>

                <button type="submit" class="btn btn-primary">

                    💾 Lưu trạng thái

                </button>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline">

                    ← Quay lại danh sách

                </a>

            </form>

        </div>

    </div>

@endsection



