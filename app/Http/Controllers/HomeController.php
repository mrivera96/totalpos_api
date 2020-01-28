<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard';
        $products = Product::where('status',1)->get();
        $users = User::where('status',1)->get();
        $customers = Customer::where('status',1)->get();
        $inventory = 0;
        foreach($products as $product){
            $inventory+=$product->in_stock;
        }

        return view('dashboard.dashboard', compact('title', 'products', 'users', 'inventory','customers'));
    }
}
