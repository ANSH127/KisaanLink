<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmerController extends Controller
{
    //

    function showAddProductForm()
    {
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
