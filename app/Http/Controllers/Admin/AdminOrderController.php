<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $baseQuery = Order::query();

        $query = (clone $baseQuery)->with(['user', 'items.product']);

        if ($status = request('status')) {
            $query->where('status', $status);
        }

        if ($dateFrom = request('date_from')) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo = request('date_to')) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        if ($search = trim((string) request('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $sort = request('sort', 'newest');
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'highest') {
            $query->orderByDesc('total');
        } elseif ($sort === 'lowest') {
            $query->orderBy('total');
        } else {
            $query->latest();
        }

        $orders = $query->paginate(20)->withQueryString();

        $totalOrders = (clone $baseQuery)->count();
        $pendingOrders = (clone $baseQuery)->where('status', Order::STATUS_PENDING)->count();
        $confirmedOrders = (clone $baseQuery)->where('status', Order::STATUS_CONFIRMED)->count();
        $preparingOrders = (clone $baseQuery)->where('status', Order::STATUS_PREPARING)->count();
        $completedOrders = (clone $baseQuery)->where('status', Order::STATUS_COMPLETED)->count();

        return view('admin.orders.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'confirmedOrders',
            'preparingOrders',
            'completedOrders'
        ));
    }

    public function show(Order $order)
    {
        $order->load('items');

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,preparing,completed,cancelled'],
        ]);

        $order->update($data);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }
}

