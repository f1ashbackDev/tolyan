<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function store($id)
    {
        $orderHistory = OrderItems::where('order_id', '=', $id)->with('products', 'image')->get();
        // хз пока
        $order = Order::find($id)->first();
        return view('historyOrder', [
            'history' => $orderHistory,
            'order' => $order
        ]);
    }
}
