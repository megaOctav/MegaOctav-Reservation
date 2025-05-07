<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/products",
     *     tags={"Product"},
     *     operationId="listProducts",
     *     summary="List of Products",
     *     description="Retrieve a list of all products",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Successfully retrieved products",
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "name": "RKJ",
     *                         "price": 200000,
     *                         "stock": 10,
     *                         "description": "Black cotton t-shirt",
     *                         "created_at": "2025-04-30T10:00:00Z",
     *                         "updated_at": "2025-04-30T10:00:00Z"
     *                     }
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved products',
            'data' => $products
        ]);
    }
}
