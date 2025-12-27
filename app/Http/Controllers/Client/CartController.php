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
        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập'
            ], 401);
        }

        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        $qty = max(1, (int) $request->input('quantity', 1));

        if ($item) {
            $item->increment('quantity', $qty);
        } else {
            CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $product->id,
                'quantity'   => $qty,
                'price'      => $product->price,
                'added_at'   => now(),
            ]);
        }


        $totalItems = CartItem::where('cart_id', $cart->id)
            ->sum('quantity');

        DB::commit();

        // ✅ LUÔN TRẢ JSON
        return response()->json([
            'success'      => true,
            'message'      => 'Đã thêm sản phẩm vào giỏ hàng',
            'total_items' => $totalItems,
        ]);

    } catch (\Throwable $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Có lỗi xảy ra',
            'error'   => $e->getMessage(),
        ], 500);
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
