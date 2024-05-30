<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Shop;
use App\Models\Category;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->get("isLogged")==null && session()->get("userId")==null){
            //return redirect()->route("home")->with("error", "Perlu Login Terlebih Dahulu!!");
            abort(401, 'Unauthorized');
        }
        
        // Ambil data user dari session
        $user = User::find(session()->get("userId"));

        if ($user) {
            view()->share('user', $user);
        }

        // Ambil shop user dari session
        $shop = Shop::find(session()->get("shopId"));

        if ($shop) {
            view()->share('shop', $shop);
        }

        // Ambil category item dari session
        $categories = Category::find(session()->get("categoryId"));

        if ($categories) {
            view()->share('categories', $categories);
        }

        return $next($request);
    }
}
