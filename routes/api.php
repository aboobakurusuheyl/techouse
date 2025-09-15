<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Navigation;
use App\Models\SiteSetting;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API routes for frontend
Route::get('/brands', function () {
    return Brand::where('is_active', true)
        ->select('id', 'name', 'slug', 'logo')
        ->get();
});

Route::get('/categories', function () {
    return Category::where('is_active', true)
        ->select('id', 'name', 'slug', 'icon')
        ->get();
});

Route::get('/products', function (Request $request) {
    $query = Product::with(['brand', 'category'])
        ->where('is_active', true);

    // Filter by brand
    if ($request->has('brand')) {
        $query->whereHas('brand', function ($q) use ($request) {
            $q->where('slug', $request->brand);
        });
    }

    // Filter by category
    if ($request->has('category')) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    // Search
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Featured products
    if ($request->has('featured')) {
        $query->where('is_featured', true);
    }

    $products = $query->paginate(12);
    
    // Transform the data to include proper image URLs
    $products->getCollection()->transform(function ($product) {
        $product->image_urls = $product->image_urls;
        return $product;
    });

    return $products;
});

Route::get('/products/{slug}', function ($slug) {
    return Product::with(['brand', 'category'])
        ->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();
});

// Navigation API routes
Route::get('/navigation/{location}', function ($location) {
    return Navigation::with('children')
        ->where('location', $location)
        ->where('is_active', true)
        ->whereNull('parent_id')
        ->orderBy('sort_order')
        ->get();
});

// Site settings API routes
Route::get('/site-settings', function () {
    return SiteSetting::getAll();
});

Route::get('/site-settings/{group}', function ($group) {
    return SiteSetting::getByGroup($group);
});
