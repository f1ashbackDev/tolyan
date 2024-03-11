<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{

    public function show()
    {
        $basket = Basket::with('product', 'productImage')->where('user_id', '=', Auth::id())->get();
        return view('user.basket', [
            'basket' => $basket
        ]);
    }

    public function store(Request $request, Products $products)
    {
        $basket = Basket::where('product_id', '=', $products->id)->first();
        if($basket != null){
            $basket->count += $request->count;
            $basket->product_sum *= $products->price * $request->count;
            $basket->save();
        }
        else{
            Basket::create([
                'user_id' => Auth::id(),
                'product_id' => $products->id,
                'product_sum' => $products->price * $request->count,
                'count' => $request->count
            ]);
        }
        return redirect()->route('index');
    }

    public function update(Request $request, Basket $basket)
    {
        $product = Products::where('id', '=', $basket->product_id)->first();
        $basket->update([
            'count' => $request->count,
            'product_sum' => $product->price * $request->count
        ]);
        return response()->json($request);
    }

    public function delete(Basket $basket)
    {
        $basket->delete();
        return redirect()->route('basket');
    }
}
