<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
     public function index()
    {
        $user = Auth::user();

        $cart = Cart::with([
            'items.product.primaryImage'
        ])->where('user_id', $user->id)->first();
        return view('client.cart.index', compact('cart'));
    }
    public function add(Request $request, Product $product)
    {
        DB::beginTransaction();

        try {
            // 🔴 CHẮC CHẮN USER ĐÃ LOGIN
            $userId = auth()->id();

            if (!$userId) {
                abort(401, 'Bạn chưa đăng nhập');
            }

            // 1️⃣ Lấy hoặc tạo cart
            $cart = Cart::firstOrCreate([
                'user_id' => $userId,
            ]);

            // ⚠️ BẮT BUỘC cart phải có id
            if (!$cart->id) {
                throw new \Exception('Không tạo được cart');
            }

            // 2️⃣ Kiểm tra sản phẩm đã có trong cart chưa
            $item = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            if ($item) {
                // 3️⃣ Nếu đã có → tăng số lượng
                $item->increment('quantity');
            } else {
                // 4️⃣ Nếu chưa có → tạo mới
                CartItem::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $product->id,
                    'quantity'   => 1,
                    'price'      => $product->price,
                    'added_at'   => now(),
                ]);
            }

            DB::commit();

            return back()->with('success', 'Đã thêm vào giỏ hàng');

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'error' => true,
                'msg'   => $e->getMessage(),
                'line'  => $e->getLine(),
            ]);
        }
    }
        public function update(Request $request, CartItem $item)
    {
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        $item->update([
            'quantity' => $request->quantity
        ]);

        // Tính lại subtotal & total
        $subtotal = $item->product->price * $item->quantity;

        $total = $item->cart->items->sum(function ($i) {
            return $i->product->price * $i->quantity;
        });

        return response()->json([
            'subtotal' => $subtotal,
            'total'    => $total
        ]);
    }
    public function destroy(CartItem $item){
        if($item->cart->user_id !== auth::id()){
            abort(403);
        }
        $item->delete();
        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
}
