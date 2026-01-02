<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
   public function index(Request $request)
    {
        $query = Product::with('images')
            ->where('is_active', 1);

        /* =====================
        * SEARCH
        * ===================== */
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        /* =====================
        * FILTER CATEGORY
        * ===================== */
        if ($request->filled('category')) {
            $categoryId = $request->category;

            $categoryIds = Category::where('id', $categoryId)
                ->orWhere('parent_id', $categoryId)
                ->pluck('id');

            $query->whereIn('category_id', $categoryIds);
        }

        /* =====================
        * FILTER PRICE
        * ===================== */
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (int)$request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (int)$request->price_max);
        }

        $products = $query->where('is_active', 1)->paginate(100)->withQueryString();

        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();

        return view('client.shop.index', compact('products', 'categories'));
    }
    public function show(Product $product)
    {
        $product->load(['images', 'category']);

        $primary = $product->images->where('is_primary', 1)->first()
                ?? $product->images->first();

        return view('client.shop.show', compact('product', 'primary'));
    }

}

