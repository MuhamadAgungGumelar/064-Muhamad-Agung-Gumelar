<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Item;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function sellerRegistrationPage($name)
    {
        $user = User::where('name', $name)->firstOrFail();

        $user_id = session()->get('user_id');
        $shop = Shop::where('user_id', $user_id)->first();

        return view('sellerRegistration', compact('user', 'shop'));
    }

    public function sellerRegistration($name, Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil user yang sedang login
        $user = User::where('name', $name)->firstOrFail();

        // Ubah role_id menjadi 2 (sebagai penjual)
        $user->role_id = 2;
        $user->save();
        
        // Buat entri baru di tabel shop
        $shop = new Shop();
        $shop->name = $request->name;
        $shop->description = $request->description;

        // Pengecekan apakah file diunggah dan menyimpannya
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $shop->image = 'images/'.$imageName;
        }

        $shop->user_id = $user->id;
        $shop->save();

        $shop_id = $shop->id;
        $request->session()->put('shop_id', $shop_id);

        return redirect()->route("dashboardIndex")->with('success', 'Registration successful!');
    }

    public function storeItemPage($name) 
    {
        $shop = Shop::where('name', $name)->firstOrFail();
        $categories = Category::all();

        $user_id = session()->get("user_id");
        $user = User::find($user_id);
        return view('storeItem', compact('shop', 'categories', 'user'));
    }

    public function storeItem($name, Request $request) 
    {
        $shop = Shop::where('name', $name)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $item = new Item([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => 'images/'.$imageName,
            'shop_id' => $shop->id,
            'categories_id' => $request->category_id
        ]);
        $item->save();
        
        return redirect()->route("dashboardIndex")->with('success', 'Registration successful!');
    }

    public function storeCategoryPage() 
    {
        return view('storeCategory');
    }

    public function storeCategory(Request $request) 
    {
        $category = new Category([
            'name' => $request->name
        ]);
        $category->save();
        
        return redirect()->route("dashboardIndex")->with('success', 'Registration successful!');
    }
}