<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/products",
     *     tags={"Product"},
     *     operationId="listProducts",
     *     summary="List of Products",
     *     description="Retrieve a list of products",
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
     *                         "product_name": "Product A",
     *                         "description": "This is product A",
     *                         "price": "100000.00",
     *                         "quota": 10,
     *                         "created_at": "2025-04-23T12:00:00Z",
     *                         "updated_at": "2025-04-23T12:00:00Z"
     *                     },
     *                     {
     *                         "id": 2,
     *                         "product_name": "Product B",
     *                         "description": "This is product B",
     *                         "price": "250000.00",
     *                         "quota": 5,
     *                         "created_at": "2025-04-23T12:30:00Z",
     *                         "updated_at": "2025-04-23T12:30:00Z"
     *                     }
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function listProducts()
    {
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved products',
            'data' => [
                [
                    'id' => 1,
                    'product_name' => 'Product A',
                    'description' => 'This is product A',
                    'price' => '100000.00',
                    'quota' => 10,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 2,
                    'product_name' => 'Product B',
                    'description' => 'This is product B',
                    'price' => '250000.00',
                    'quota' => 5,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        ]);
    }
}
