<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use App\Models\CartItem;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $count = 0;

            if (auth()->check()) {
                $cart = Cart::where('user_id', auth()->id())->first();

                if ($cart) {
                    $count = CartItem::where('cart_id', $cart->id)
                        ->sum('quantity');
                }
            }

            $view->with('cartItemCount', $count);
        });
    }
}
