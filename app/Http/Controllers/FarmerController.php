<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\Order;

class FarmerController extends Controller
{
    //

    function showAddProductForm()
    {

        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        return view('seller.AddProductForm');
    }



    function handleAddProduct(Request $request)
    {
        // logic
        $product = new ProductDetail();
        $product->product_name = $request->input('product_name');
        $product->produce_type = $request->input('produce_type');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->quality_grade = $request->input('quality_grade');
        $product->available_dates_from = $request->input('available_dates_from');
        $product->available_dates_to = $request->input('available_dates_to');
        $product->image_url = $request->input('image_url');
        $product->additional_notes = $request->input('additional_notes');
        $product->seller_id = session('user')->id;
        $product->save();
        return redirect('/products')->with('success', 'Product added successfully');



    }


    function showProductList()
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        $products = ProductDetail::where('seller_id', session('user')->id)->get();
        return view('seller.ProductList', ['products' => $products]);
    }
    function deleteProduct($id)
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        $product = ProductDetail::find($id);
        if ($product) {
            $product->delete();
            return redirect('/products')->with('success', 'Product deleted successfully');
        } else {
            return redirect('/products')->with('error', 'Product not found');
        }
    }
    function editProductForm($id)
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        $product = ProductDetail::find($id);
        if ($product) {
            return view('seller.EditProductForm', ['product' => $product]);
        } else {
            return redirect('/products')->with('error', 'Product not found');
        }
    }
    function updateProduct(Request $request, $id)
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        $product = ProductDetail::find($id);
        if ($product) {
            $product->product_name = $request->input('product_name');
            $product->produce_type = $request->input('produce_type');
            $product->quantity = $request->input('quantity');
            $product->price = $request->input('price');
            $product->quality_grade = $request->input('quality_grade');
            $product->available_dates_from = $request->input('available_dates_from');
            $product->available_dates_to = $request->input('available_dates_to');
            $product->image_url = $request->input('image_url');
            $product->additional_notes = $request->input('additional_notes');
            $product->save();
            return redirect('/products')->with('success', 'Product updated successfully');
        } else {
            return redirect('/products')->with('error', 'Product not found');
        }
    }

    function showOrders()
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        // logic to show orders
        $orders = Order::with('product', 'buyer')
            ->where('seller_id', session('user')->id)
            ->orderBy('created_at','desc')
            ->get();
        
        return view('Seller.ViewOrdersPage', ['orders' => $orders]);
    }

    function productquantityupdate($pid, $quantity)
    {
        $product = ProductDetail::find($pid);
        if ($product) {
            $product->quantity -= $quantity;
            $product->save();
        }



    }

    function acceptOrder($id)
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        $order = Order::find($id);
        if (!$order) {
            return redirect('/f/orders')->with('error', 'Order not found');
        }
        // Check if the order is already accepted or rejected
        if ($order->status == 'Accepted' || $order->status == 'Rejected') {
            return redirect('/f/orders')->with('error', 'Order already accepted or rejected');
        }

        if ($order) {

            // update the quantity of the product
            $this->productquantityupdate($order->product_id, $order->quantity);

            $order->status = 'Accepted';
            // $order->delivery_date=now()->addDays(7);
            // $order->delivery_status = 'Processing';
            // $order->payment_method = 'Cash on Delivery';
            $order->save();
            return redirect('/f/orders')->with('success', 'Order accepted successfully');
        } 
        
    }
    function rejectOrder($id)
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        $order = Order::find($id);
        if ($order) {
            $order->status = 'Rejected';
            $order->cancelledby = 'Seller';
            
            $order->save();
            return redirect('/f/orders')->with('success', 'Order rejected successfully');
        } else {
            return redirect('/f/orders')->with('error', 'Order not found');
        }
    }

    function showcounterOfferForm($id)
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        $order = Order::where('id', $id)->where('status', 'Pending')->first();
        if (!$order) {
            return redirect('/f/orders')->with('error', 'Order not found or already accepted/rejected');
        }
        return view('seller.CounterOfferForm', ['order' => $order]);
        
    }

    function counterOffer(Request $request, $id)
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Seller') {
            return redirect('/login')->with('error', 'You are not authorized to access this page');
        }
        $order = Order::find($id);
        if ($order) {
            $order->counter_price = $request->input('counter_offer_price');
            $order->status = 'Countered';
            $order->save();
            return redirect('/f/orders')->with('success', 'Counter offer sent successfully');
        } else {
            return redirect('/f/orders')->with('error', 'Order not found');
        }
    }



   
}
