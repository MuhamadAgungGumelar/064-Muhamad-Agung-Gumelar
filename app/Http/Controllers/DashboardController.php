<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Cart;

class DashboardController extends Controller
{
    public function dashboardIndex()
    {
        $items = Item::all();
        $shops = Shop::all();
        $categories = Category::all();
        
        $user_id = session()->get('user_id');
        
        $shop = Shop::where('user_id', $user_id)->first();

        
        if($shop != null) {
            $transactionShopCount = Transaction::where('shop_id', $shop->id)->count();
            $transactionShopCount = session()->put('transactionShopCount', $transactionShopCount);
            return view('dashboard', compact('items', 'shops', 'categories', 'shop'));
        }

        return view('dashboard', compact('items', 'shops', 'categories'));
    }

    public function showByCategory($category_name)
    {
        $category = Category::where('name', $category_name)->firstOrFail();
        $items = Item::where('categories_id', $category->id)->get();
        $categories = Category::all();
        $shops = Shop::all();

        $user_id = session()->get('user_id');

        $shop = Shop::where('user_id', $user_id)->first();
        return view('dashboard', compact('items', 'categories', 'category', 'shops', 'shop'));
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
