<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/customers",
     *     tags={"Customer"},
     *     operationId="listCustomers",
     *     summary="List of Customers",
     *     description="Retrieve a list of customers",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Customers retrieved successfully.",
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "name": "John Doe",
     *                         "email": "john@example.com",
     *                         "phone": "08123456789",
     *                         "address": "Jl. Mawar No.1",
     *                         "id_login": 1,
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
            'status' => 200,
            'message' => 'Customers retrieved successfully.',
            'data' => $customers
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/customers",
     *     tags={"Customer"},
     *     operationId="createCustomer",
     *     summary="Create a new Customer",
     *     description="Create a new customer with required fields",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","phone","address","id_login"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="address", type="string"),
     *             @OA\Property(property="id_login", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Customer created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 201,
     *                 "message": "Customer created successfully.",
     *                 "data": {
     *                     "id": 2,
     *                     "name": "Jane Doe",
     *                     "email": "jane@example.com",
     *                     "phone": "08198765432",
     *                     "address": "Jl. Melati No.2",
     *                     "id_login": 2
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:6',
            'address' => 'required|string',
            'id_login' => 'required|integer',
        ]);

        $customer = customer::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Customer created successfully.',
            'data' => $customer
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/customers/{id}",
     *     tags={"Customer"},
     *     operationId="getCustomerById",
     *     summary="Get Customer by ID",
     *     description="Returns a single customer",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer retrieved successfully",
     *         @OA\JsonContent(...)
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Customer not found"
     *     )
     * )
     */
    public function show($id)
    {
        $customer = customer::find($id);

        if (!$customer) {
            return response()->json([
                'status' => 404,
                'message' => 'Customer not found.',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Customer retrieved successfully.',
            'data' => $customer
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/customers/{id}",
     *     tags={"Customer"},
     *     operationId="updateCustomer",
     *     summary="Update a Customer",
     *     description="Update an existing customer by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","phone","address","id_login"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="address", type="string"),
     *             @OA\Property(property="id_login", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Customer not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $customer = customer::find($id);

        if (!$customer) {
            return response()->json([
                'status' => 404,
                'message' => 'Customer not found.',
            ], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:6',
            'address' => 'required|string',
            'id_login' => 'required|integer',
        ]);

        $customer->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Customer updated successfully.',
            'data' => $customer
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/customers/{id}",
     *     tags={"Customer"},
     *     operationId="deleteCustomer",
     *     summary="Delete a Customer",
     *     description="Deletes a customer by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Customer not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $customer = customer::find($id);

        if (!$customer) {
            return response()->json([
                'status' => 404,
                'message' => 'Customer not found.',
            ], 404);
        }

        $customer->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Customer deleted successfully.',
        ], 200);
    }
}
