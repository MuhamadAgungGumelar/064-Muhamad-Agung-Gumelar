<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Shop;
use App\Models\Category;

class DashboardController extends Controller
{
    public function dashboardIndex()
    {
        $items = Item::all();
        $shops = Shop::all();
        $categories = Category::all();
        return view('dashboard', compact('items', 'shops', 'categories'));
    }

    public function showByCategory($category_name)
    {
        $category = Category::where('name', $category_name)->firstOrFail();
        $items = Item::where('categories_id', $category->id)->get();
        $categories = Category::all();
        $shops = Shop::all();
        return view('dashboard', compact('items', 'categories', 'category', 'shops'));
    }

    public function showByShop($shop_name)
    {   
        $shop = Shop::where('name', $shop_name)->firstOrFail();
        $items = Item::where('shop_id', $shop->id)->get();
        $categories = Category::all();
        $shops = Shop::all();
        return view('showByShop', compact('items', 'categories', 'shops', 'shop'));
    }

    public function showByShopItem($shop_name, $category_name)
    {
        $category = Category::where('name', $category_name)->firstOrFail();
        $shop = Shop::where('name', $shop_name)->firstOrFail();
        $items = Item::where('shop_id', $shop->id)
        ->where('categories_id', $category->id)
        ->get();
        $categories = Category::all();
        $shops = Shop::all();

        return view('showByShopItem', compact('items', 'categories', 'shops', 'shop', 'category'));
    }
}
