<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $categoryId = $request->input('category');
        $sort = $request->input('sort', 'latest');

        $products = Product::where('is_active', true)
            ->when($query, function ($q) use ($query) {
                return $q->where(function ($subQ) use ($query) {
                    $subQ->where('name', 'like', '%' . $query . '%')
                         ->orWhere('description', 'like', '%' . $query . '%');
                });
            })
            ->when($categoryId, function ($q) use ($categoryId) {
                return $q->where('category_id', $categoryId);
            });

        // Sorting
        switch ($sort) {
            case 'price_asc':
                $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products->orderBy('price', 'desc');
                break;
            case 'oldest':
                $products->orderBy('created_at', 'asc');
                break;
            default: // latest
                $products->latest();
                break;
        }

        $products = $products->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('search.index', compact('products', 'categories', 'query', 'sort', 'categoryId'));
    }
}
