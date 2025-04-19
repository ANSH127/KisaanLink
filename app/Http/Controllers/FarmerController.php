<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetail;

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
}
