<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\Order;


class BuyerController extends Controller
{
    function showDashboard()
    {
        // fetch all the products with seller details 
        $products = ProductDetail::with('seller')->get();

        return view('Dashboard', ['products' => $products]);
    }

    function showProductDetails($id)
    {
        // fetch the product details with seller details
        $product = ProductDetail::with('seller')->where('id', $id)->first();

        return view('ProductDetailPage', ['product' => $product]);
    }
    function showOrders()
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Purchaser') {
            return redirect('/dashboard')->with('error', 'You are not authorized to access this page');
        }

        $orders = Order::with(['product', 'seller'])->where('buyer_id', session('user')->id)->get();
        if ($orders->isEmpty()) {
            return redirect('/dashboard')->with('error', 'No orders found');
        }

        return view('Buyer.ViewOrdersPage', ['orders' => $orders]);
    }
}
