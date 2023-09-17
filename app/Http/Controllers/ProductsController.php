<?php

namespace App\Http\Controllers;

use App\Models\Message;
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

    function messages($seller){
        $cusId = 1; // Auth::id() for proper application
        $msgs = Message::where('customer_id',$cusId)->where('seller_id',$seller)->orderBy('id','desc')->get(); // using product id instead of seller for testing
        return response()->json([
            'success' => true,
            'data' => $msgs
        ]);
    }

    function sendMessage(Request $request){
        Message::create([
            'customer_id' => 1, // AUth::id() orignally
            'seller_id' => $request->productId,     // no seller record for now
            'sender' => 'customer',          // will be 'seller' for seller side apis
            'message' => $request->msg,
            'status' => 0
        ]);
        return response()->json([
            'success' => true,
            'message' => "messsage sent"
        ]);
    }
}
