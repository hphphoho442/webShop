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

            // Lấy toàn bộ category con
            $categoryIds = Category::where('id', $categoryId)
                ->orWhere('parent_id', $categoryId)
                ->pluck('id');

            $query->whereIn('category_id', $categoryIds);
        }

        $products = $query->paginate(30)->withQueryString();

        /* =====================
         * CATEGORY TREE (sidebar)
         * ===================== */
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();

        return view('client.shop.index', compact('products', 'categories'));
    }
}
