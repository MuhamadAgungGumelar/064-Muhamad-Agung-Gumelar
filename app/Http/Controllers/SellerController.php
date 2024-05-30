<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function sellerRegistrationPage($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        return view('sellerRegistration', compact('user'));
    }

    public function sellerRegistration($name, Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Ambil user yang sedang login
        $user = User::where('name', $name)->firstOrFail();

        // if (!$user) {
        //     // Jika tidak ada pengguna yang login, kembalikan dengan error
        //     return redirect()->route('loginPage')->with('error', 'You must be logged in to register as a seller.');
        // }

        // Ubah role_id menjadi 2 (sebagai penjual)
        $user->role_id = 2;
        $user->save();
        
        // Buat entri baru di tabel shop
        $shop = new Shop();
        $shop->name = $request->name;
        $shop->user_id = $user->id;
        $shop->save();

        return redirect()->route("dashboard")->with('success', 'Registration successful!');
    }

    public function storeItemPage($name) {
        $shop = Shop::where('name', $name)->firstOrFail();
        $categories = Category::all();
        return view('storeItem', compact('shop', 'categories'));
    }

    public function storeItem($name, Request $request) {
        $shop = Shop::where('name', $name)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric'
        ]);


        $item = new Item([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'shop_id' => $shop->id,
            'categories_id' => $request->category_id
        ]);
        $item->save();
        
        return redirect()->route("dashboardIndex")->with('success', 'Registration successful!');
    }

    public function storeCategoryPage() {
        return view('storeCategory');
    }

    public function storeCategory(Request $request) {
        $category = new Category([
            'name' => $request->name
        ]);
        $category->save();
        
        return redirect()->route("dashboardIndex")->with('success', 'Registration successful!');
    }


}