<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Dotenv\Validator;   
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::latest()->get();
        return response()->json([ProductResource::collection($data),'programs fetched']);
    }
    //input data
    public function store(Request $request)
    {
            $validator = Validator::make($request->all(),[
                'product_name'=> 'required | string |max:255 ',
                'price'=> 'required | string',
                'desc' => 'required | string ',
            ]);
    }

}
