<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request, Product $product)
    {
        return view('buyer.product.order', [
            'product' => $product,
            // dd($product)
        ]);
    }

    public function place_order(Request $request)
    {
        $request->validate([
            'address' => ['required'],
            'phone_no' => ['required', 'unique:orders,phone_no'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        // $product = Product::all()->orders();
        // $product = Product::find($request->product_id);
        $user = Auth::user();

        $product_id = $request->input('product_id');
        $product = Product::find($product_id);;
        $quantity = $request->quantity;

        $final_price = $product->price * $quantity;

        $data = [
            'address' => $request->address,
            'phone_no' => $request->phone_no,
            'product_id' => $product_id,
            'user_id' => $user->id,
            'quantity' => $quantity,
            'user_name' => $user->name,
            'final_price' => $final_price,
            'product_name' => $product->name,

        ];

        $is_created = Order::create($data);

        $message = $is_created ? ['success' => 'Order has been successfully placed! The owner will contact you to confirm soon.'] : ['failure' => 'Failed to create order'];

        return back()->with($message);
    }

    public function view_placed_order()
    {
        if (Auth::user()->role == 'seller') {

            $orders = Order::whereIn('product_id', function ($query) {
                $query->select('product_id')
                    ->from('products')
                    ->where('owner_id', Auth::user()->id);
            })->get();

            return view('seller.product.viewPlacedOrder', [
                'orders' => $orders,
            ]);
        } else {
            return back()->withErrors([
                'failure' => 'Image could not be uploaded',
            ]);
        }
    }
}
