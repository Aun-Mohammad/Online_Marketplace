<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ProductController extends Controller
{

    public function create()
    {
        return view('seller.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric', 'integer', 'min:0'],
            'image' => ['required', 'image', 'mimes:png,jpg, jpeg'],
        ]);

        // $product = User::find($owner = $request->id);
        $product = User::find(Auth::user()->id);
        $new_name = "INV_PRO" . (microtime(true) . "." . $request->image->extension());
        if ($request->image->move(public_path('template/img/products'), $new_name)) {
            $data = [
                // 'id' => $users->id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $new_name,
                'owner_id' => $product->id,
            ];

            $is_created = Product::create($data);

            $message = $is_created ? ['success' => 'Product has been added'] : ['failure' => 'Failed to add Product'];

            return back()->with($message);
        } else {
            return back()->withErrors([
                'image' => 'Image could not be uploaded',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function view(Product $product)
    {
        return view('seller.product.view', [
            'product' => $product,
            // dd($product)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('seller.product.edit', [
            'product' => $product,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric', 'integer', 'min:0'],
            'image' => ['required', 'image', 'mimes:png,jpg, jpeg'],
        ]);



        unlink(public_path('template/img/products/' . $product->image));

        $new_name = "INV_PRO" . microtime(true) . "." . $request->image->extension();

        $request->image->move(public_path('template/img/products'), $new_name);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $new_name,


        ];

        $is_updated = $product->update($data);

        $message = $is_updated ? ['success' => 'Product has been successfully updated'] : ['failure' => 'Failed to edit the Product'];

        return back()->with($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {


        $is_deleted = $product->delete();

        $is_deleted ? $message = ['success' => 'Product has been successfully deleted'] : ['failure' => 'Failed to deleted the Product '];

        return back()->with($message);
    }

    public function buyer_view(Product $product)
    {
        return view('buyer.product.view', [
            'product' => $product,
        ]);
    }


}
