<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Shop;
use App\Models\Item;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Category;

class TransactionController extends Controller
{
    public function addToCart(Request $request, $item_name)
    {
        $item = Item::where('name', $item_name)->firstOrFail();
        $user_id = session()->get('user_id');
        $user = User::where('id', $user_id)->firstOrFail();

        $cart = Cart::where('user_id', $user->id)
        ->where('item_id', $item->id)
        ->first();

        if ($cart) {
            // Jika item sudah ada di keranjang, tambahkan quantity
            $cart->quantity += 1;
            $cart->save();
        } else {
            // Jika item belum ada di keranjang, buat entri baru
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->item_id = $item->id;
            $cart->status_id = 1;
            $cart->quantity = 1;
            $cart->save();

            //$request->session()->put('status_id', $cart->statuses_id);
        }  

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function viewCart($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        $cartItems = Cart::where('user_id', $user->id)
                    ->where('completed', false) // Tambahkan kondisi ini
                    ->with(['item', 'user'])
                    ->get();

        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $totalQuantity += $cartItem->quantity;
            $totalPrice += $cartItem->item->price * $cartItem->quantity;
        }

        session(['totalQuantity' => $totalQuantity]);
        session(['totalPrice' => $totalPrice]);

        $user_id = session()->get('user_id');

        $shop = Shop::where('user_id', $user_id)->first();

        return view('cart', compact('cartItems', 'user', 'totalQuantity', 'totalPrice', 'shop'));
    }

    public function minusItem($item_name){
        
        $item = Item::where('name', $item_name)->firstOrFail();
        $user_id = session()->get('user_id');
        $user = User::where('id', $user_id)->firstOrFail();

        $cart = Cart::where('user_id', $user->id)
        ->where('item_id', $item->id)
        ->first();

        if ($cart) {
            $cart->quantity -= 1;

            if ($cart->quantity <= 0) {
                $cart->delete();
            } else {
                $cart->save();
            }
        }

        return redirect()->back()->with('success', 'Item quantity updated!');
    }

    public function plusItem($item_name){
        
        $item = Item::where('name', $item_name)->firstOrFail();
        $user_id = session()->get('user_id');
        $user = User::where('id', $user_id)->firstOrFail();

        $cart = Cart::where('user_id', $user->id)
        ->where('item_id', $item->id)
        ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        }

        return redirect()->back()->with('success', 'Item quantity updated!');
    }

    public function checkout($name)
    {
        $totalQuantity = session('totalQuantity');
        $totalPrice = session('totalPrice');

        $user = User::where('name', $name)->firstOrFail();

        $cartItems = Cart::where('user_id', $user->id)->get();

        // Buat entri baru dalam tabel checkout
        foreach ($cartItems as $cartItem) {
            $cartItem->completed = true;
            $cartItem->save();
        }

        $cartItems2 = Cart::where('user_id', $user->id)
        ->where('completed', true) // Tambahkan kondisi ini
        ->with(['item', 'user'])
        ->get();

        $checkout = new Transaction();
        $checkout->user_id = $user->id;
        $checkout->total_quantity = $totalQuantity;
        $checkout->total_price = $totalPrice;
        $checkout->status_id = 2;
        $checkout->shop_id = $cartItems2[0]->item->shop_id;
        $checkout->save();
        
        foreach ($cartItems2 as $cartItem2) {
            $transactionDetail = new TransactionDetail();
            $transactionDetail->name = $cartItem2->item->name;
            $transactionDetail->quantity = $cartItem2->quantity;
            $transactionDetail->price = $cartItem2->item->price;
            $transactionDetail->transaction_id = $checkout->id;
            $transactionDetail->save();
        }
        
        if($cartItem->completed = true){
            Cart::where('user_id', $user->id)->delete();
        }
        return redirect()->route('dashboardIndex')->with('success', 'Checkout successful!');
    }

    public function viewTransaction(){

        $user_id = session()->get('user_id');
        $user = User::where('id', $user_id)->firstOrFail();
        
        $shop = Shop::where('user_id', $user->id)->first();

        $transactions = Transaction::where('user_id', $user->id)
        ->with('shop', 'status')
        ->paginate(3);

        return view('transaction', compact('transactions', 'user', 'shop'));
    }

    public function viewTransactionDetail($name, $transaction_id){
        $user = User::where('name', $name)->firstOrFail();
        $transaction = Transaction::where('id', $transaction_id)->firstOrFail();
        $transactionDetails = TransactionDetail::where('transaction_id', $transaction_id)->get();
        
        $user_id = session()->get('user_id');

        $shop = Shop::where('user_id', $user_id)->first();

        return view('transactiondetail', compact('transactionDetails', 'user', 'transaction', 'shop'));
    }

    public function shopTransactionPage($name) 
    {
        $user_id = session()->get('user_id');
        $user = User::where('id', $user_id)->firstOrFail();
        $shop = Shop::where('name', $name)->firstOrFail();
        
        $transactions = Transaction::where('shop_id', $shop->id)
        ->with('shop', 'status')
        ->paginate(3);

        return view('shopTransactionPage', compact('shop', 'user', 'transactions'));
    }

    public function shopTransactionAccept($shop, $transaction_id){
        $shop = Shop::where('name', $shop)->firstOrFail();
        $transaction = Transaction::where('id', $transaction_id)->where('shop_id', $shop->id)->firstOrFail();
        
        $transaction->status_id = 3;
        $transaction->save();
        
        $items = Item::where('shop_id', $shop->id)->get();
        $transactionDetails = TransactionDetail::where('transaction_id', $transaction_id)->get();

        foreach ($items as $item) {
            foreach ($transactionDetails as $transactionDetail) {
                if ($item->name === $transactionDetail->name) {
                    $item->quantity -= $transactionDetail->quantity;
                    $item->save();
                }
            }
        }

        return redirect()->route('dashboardIndex')->with('success', 'Transaction accepted!');
    }

    public function shopTransactionReject($shop, $transaction_id){
        $shop = Shop::where('name', $shop)->firstOrFail();
        $transaction = Transaction::where('id', $transaction_id)->where('shop_id', $shop->id)->firstOrFail();
        
        $transaction->status_id = 4;
        $transaction->save();
        
        return redirect()->route('dashboardIndex')->with('success', 'Transaction rejected!');
    }

    public function shopCatalog($name)
    {
        $user_id = session()->get('user_id');
        $user = User::where('id', $user_id)->firstOrFail();
        $shop = Shop::where('name', $name)->firstOrFail();
        $items = Item::where('shop_id', $shop->id)->get();
        $categories = Category::all();
        $shops = Shop::all();

        return view('shopCatalog', compact('items', 'categories', 'shops', 'shop', 'user'));
    }
}