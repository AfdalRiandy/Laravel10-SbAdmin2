<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with(['category', 'user.penjualProfile', 'images'])->where('is_active', true)->latest()->take(8)->get();
        
        $banners = Banner::where('is_active', true)->get();

        $popularShops = \App\Models\User::role('penjual')
            ->with('penjualProfile')
            ->withCount(['products as active_products_count' => function ($query) {
                $query->where('is_active', true);
            }])
            ->withSum('soldItems as total_sold', 'quantity')
            ->orderByDesc('total_sold')
            ->take(4)
            ->get();
        
        return view('home', compact('categories', 'products', 'banners', 'popularShops'));
    }
}
