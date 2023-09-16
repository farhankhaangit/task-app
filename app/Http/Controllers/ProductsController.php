<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //

    function index(){
        return response()->json([
            'success' => true,
            'data' => Product::orderBy('created_at','desc')->get()
        ]);
    }

    // I know its not correct way, correct way would be different tables for both
    // and their foreign keys in product table. but that will take time
    function brands(){
        $brands = Product::pluck('brand')->toArray();
        $brands = array_values(array_unique($brands));
        return response()->json([
            'success' => true,
            'data' => $brands
        ]);
    }

    function categories(){
        $categories = Product::pluck('category')->toArray();
        $categories = array_values(array_unique($categories));
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
}
