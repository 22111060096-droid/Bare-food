<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    protected function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    protected function saveCart(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

    public function index(Request $request)
    {
        $cart = $this->getCart($request);
        $items = [];
        $subtotal = 0;
        $totalCalories = 0;

        foreach ($cart as $productId => $row) {
            $product = Product::query()->find($productId);
            if (! $product) {
                continue;
            }

            $qty = (int)($row['qty'] ?? 1);
            $lineTotal = $product->price * $qty;
            $lineCalories = ($product->calories ?? 0) * $qty;

            $subtotal += $lineTotal;
            $totalCalories += $lineCalories;

            $items[] = [
                'product' => $product,
                'qty' => $qty,
                'line_total' => $lineTotal,
                'line_calories' => $lineCalories,
            ];
        }

        return view('cart.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'totalCalories' => $totalCalories,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'qty' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        $cart = $this->getCart($request);
        $productId = (int)$request->input('product_id');
        $qty = (int)($request->input('qty', 1));

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += $qty;
        } else {
            $cart[$productId] = ['qty' => $qty];
        }

        $this->saveCart($request, $cart);

        return redirect()->route('cart.index')->with('success', 'Đã thêm món vào giỏ hàng.');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'items' => ['required', 'array'],
            'items.*.product_id' => ['required', 'integer'],
            'items.*.qty' => ['required', 'integer', 'min:0', 'max:10'],
        ]);

        $cart = [];
        foreach ($data['items'] as $item) {
            if ($item['qty'] > 0) {
                $cart[(int)$item['product_id']] = ['qty' => (int)$item['qty']];
            }
        }

        $this->saveCart($request, $cart);

        return redirect()->route('cart.index')->with('success', 'Cập nhật giỏ hàng thành công.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
        ]);

        $cart = $this->getCart($request);
        unset($cart[(int)$request->input('product_id')]);
        $this->saveCart($request, $cart);

        return redirect()->route('cart.index')->with('success', 'Đã xoá món khỏi giỏ hàng.');
    }

    public function checkoutForm(Request $request)
    {
        $cart = $this->getCart($request);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống.');
        }

        return view('cart.checkout');
    }

    public function checkoutSubmit(Request $request)
    {
        $cart = $this->getCart($request);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống.');
        }

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'customer_address' => ['nullable', 'string', 'max:500'],
            'note' => ['nullable', 'string', 'max:1000'],
            'dining_option' => ['required', 'in:eat_in,takeaway'],
            'payment_method' => ['required', 'in:cod,transfer,momo,zalopay,vnpay,card'],
        ]);

        $itemsData = [];
        $subtotal = 0;
        $totalCalories = 0;

        foreach ($cart as $productId => $row) {
            $product = Product::query()->find($productId);
            if (! $product) {
                continue;
            }
            $qty = (int)($row['qty'] ?? 1);
            $lineTotal = $product->price * $qty;
            $lineCalories = ($product->calories ?? 0) * $qty;

            $subtotal += $lineTotal;
            $totalCalories += $lineCalories;

            $itemsData[] = [
                'product' => $product,
                'qty' => $qty,
                'line_total' => $lineTotal,
                'line_calories' => $lineCalories,
            ];
        }

        if (empty($itemsData)) {
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy món trong giỏ.');
        }

        $order = new Order();
        $order->fill([
            'user_id' => Auth::id(),
            'code' => 'BARE-' . Str::upper(Str::random(6)),
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'customer_email' => $data['customer_email'] ?? null,
            'customer_address' => $data['customer_address'] ?? null,
            'note' => $data['note'] ?? null,
            'dining_option' => $data['dining_option'],
            'payment_method' => $data['payment_method'],
            'subtotal' => $subtotal,
            'discount_amount' => 0,
            'total' => $subtotal,
            'total_calories' => $totalCalories,
            'status' => Order::STATUS_PENDING,
        ]);
        $order->save();

        foreach ($itemsData as $row) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $row['product']->id,
                'product_name' => $row['product']->name,
                'quantity' => $row['qty'],
                'unit_price' => $row['product']->price,
                'total_price' => $row['line_total'],
                'calories' => $row['line_calories'],
                'toppings_summary' => null,
            ]);
        }

        $this->saveCart($request, []);

        return redirect()->route('home')->with('success', 'Đặt hàng thành công! Mã đơn: ' . $order->code);
    }
}

