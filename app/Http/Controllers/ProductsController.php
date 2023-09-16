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
            'data' => Product::all()
        ]);
    }
}
