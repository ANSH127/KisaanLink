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

        $orders = Order::with(['product', 'seller'])->where('buyer_id', session('user')->id)
        ->orderBy('created_at', 'desc')
        ->get();
        if ($orders->isEmpty()) {
            return redirect('/dashboard')->with('error', 'No orders found');
        }

        return view('Buyer.ViewOrdersPage', ['orders' => $orders]);
    }

    function showOrderDetails($id)
    {
        // fetch the order details with product and seller details
        $order = Order::with(['product', 'seller'])->where('id', $id)->first();

        if (!$order) {
            return redirect('/orders')->with('error', 'Order not found');
        }

        return view('Buyer.OrderDetailsPage', ['order' => $order]);
    }

    function cancelOrder(Request $request, $id)
    {
        // fetch the order details
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return redirect('/orders')->with('error', 'Order not found');
        }

        // update the order status and reason
        $order->status = 'Cancelled';
        $order->cancelledby = 'Buyer';
        $order->save();

        return redirect('/orders')->with('success', 'Order cancelled successfully');
    }

    function searchProducts(Request $request)
    {
        $query = $request->input('query');

        // fetch all the products with seller details that match the search query
        $products = ProductDetail::with('seller')
            ->where('product_name', 'LIKE', "%$query%")
            ->get();

        return view('Dashboard', ['products' => $products]);
    }

}
