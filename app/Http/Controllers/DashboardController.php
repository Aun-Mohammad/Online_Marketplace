<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function seller()
    {
        return view('seller-dashboard', [
            'products' =>  Product::all(),
        ]);
    }

    public function buyer()
    {
        return view('buyer-dashboard', [
            'products' => Product::all(),


        ]);
    }
}
