<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Notifications\OrderPlaced;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $orders = Order::where('user_id' , $user->id)->where('status' , 'pending')->get();

        $orders_total = $orders->sum('total');

        return [
            'orders_total_price' => $orders_total,
            'orders' => $orders
        ];
    }

    public function addOrder(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|numeric',
            'quantity'  => 'required|numeric'
        ]);

        $product = Product::findOrFail($data['product_id']);

        $user = auth()->user();

        if($data['quantity'] > $product->stock)
        {
            return response()->json(['message' => "Product is out of stock"], 400);
        }

        if(!$product->is_active)
        {
            return response()->json(['message' => "Product isn't available right now"]
            , 400);
        }

        $total = $data['quantity'] * $product->price;

        $product_price = $product->price;

        $data = array_merge($data, ['total' => $total , 'product_price' => $product_price]);

        $order = Order::where('user_id' , $user->id)->where('product_id' , $product->id)->first();

        if($order)
        {
            $this->updateOrder($order , $data);

            return response()->json(['message' => "Order updated successfully"], 200);
        }

        $order = new Order($data);

        $product->orders()->save($order);

        $user->orders()->save($order);

        return response()->json(['message' => "Order added successfully"], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function updateOrder( $order ,$data )
    {
        $order->update($data);

        $order->save($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function placeOrders()
    {
        $user = auth()->user();

        Order::where('user_id' , $user->id)->where('status' , 'pending')->update(['status' => 'ordered']);

        $user->notify(new OrderPlaced());

        return response()->json(['message' => "Orders placed successfully , Please check your email"], 200);
    }
}
