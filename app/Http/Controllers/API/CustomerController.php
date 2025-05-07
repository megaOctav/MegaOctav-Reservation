<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/customers",
     *     tags={"Customer"},
     *     operationId="listCustomers",
     *     summary="List of Customers",
     *     description="Retrieve a list of all customers",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Successfully retrieved customers",
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "name": "John Doe",
     *                         "email": "john@example.com",
     *                         "phone": "08123456789",
     *                         "address": "Jl. Merdeka No.1",
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
        $customers = Customer::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved customers',
            'data' => $customers
        ]);
    }
}
