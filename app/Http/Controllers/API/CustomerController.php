<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $customers = customer::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved customers',
            'data' => $customers
        ]);
    }

    /**
     * @OA\Post(
     *     path="/customers",
     *     tags={"Customer"},
     *     summary="Create a new customer",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "phone", "address"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="address", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Customer created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 201,
     *                 "message": "Customer created successfully.",
     *                 "data": {}
     *             }
     *         )
     *     )
     * )
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|min:6',
            'address' => 'required|string',
        ]);

        $customer = customer::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Customer created successfully.',
            'data' => $customer
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/customer/{id}",
     *     tags={"Customer"},
     *     summary="Get admin by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id)
    {
        $customer = customer::find($id);
        if (!$customer) {
            return response()->json(['status' => 404, 'message' => 'Customer not found'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Customer found', 'data' => $customer]);
    }


    /**
     * @OA\Put(
     *     path="/customers/{id}",
     *     tags={"Customer"},
     *     summary="Update a customer",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="address", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer updated successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Customer updated successfully.",
     *                 "data": {}
     *             }
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $customer = customer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => ['sometimes', 'email', Rule::unique('customers')->ignore($id)],
            'phone' => 'sometimes|string|min:6',
            'address' => 'sometimes|string',
        ]);

        $customer->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Customer updated successfully.',
            'data' => $customer
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/customers/{id}",
     *     tags={"Customer"},
     *     summary="Delete a customer",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer deleted successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Customer deleted successfully."
     *             }
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $customer = customer::findOrFail($id);
        $customer->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Customer deleted successfully.'
        ]);
    }
}
