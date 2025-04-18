<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        echo $request->input('product_name');
        echo $request->input('produce_type');
        echo $request->input('quantity');
        echo $request->input('price');
        echo $request->input('quality_grade');
        echo $request->input('available_dates_from');
        echo $request->input('available_dates_to');
        echo $request->input('available_dates_to');
        echo $request->input('image_url');
        echo $request->input('additional_notes');


    }
}
