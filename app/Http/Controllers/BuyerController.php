<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ProductDetail;


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
}
