<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = product::all();

        return response()->json([
            'status' => 200,
            'message' => 'Customers retrieved successfully.',
            'data' => $products
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quota' => 'required|integer'
        ]);

        $product = product::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Product created successfully.',
            'data' => $product
        ], 201);
    }

    public function show($id)
    {
        $product = product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found.',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Customer retrieved successfully.',
            'data' => $product
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $product = product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found.',
            ], 404);
        }

        $request->validate([
            'product_name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quota' => 'required|integer'
        ]);

        $product->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Product updated successfully.',
            'data' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found.',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Product deleted successfully.',
        ], 200);
    }
}
