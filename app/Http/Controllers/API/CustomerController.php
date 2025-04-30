<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
 * @OA\Get(
 *     path="/customers",
 *     tags={"Customer"},
 *     summary="Get all customers",
 *     description="Returns list of customers",
 *     operationId="getCustomers",
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
 *                         "address": "123 Street",
 *                         "id_login": 1
 *                     }
 *                 }
 *             }
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/customers",
 *     tags={"Customer"},
 *     summary="Create a new customer",
 *     operationId="createCustomer",
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
 *                     "id": 1,
 *                     "name": "John Doe",
 *                     "email": "john@example.com",
 *                     "phone": "08123456789",
 *                     "address": "123 Street",
 *                     "id_login": 1
 *                 }
 *             }
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     path="/customers/{id}",
 *     tags={"Customer"},
 *     summary="Get a customer by ID",
 *     operationId="getCustomerById",
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

/**
 * @OA\Put(
 *     path="/customers/{id}",
 *     tags={"Customer"},
 *     summary="Update a customer",
 *     operationId="updateCustomer",
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

/**
 * @OA\Delete(
 *     path="/customers/{id}",
 *     tags={"Customer"},
 *     summary="Delete a customer",
 *     operationId="deleteCustomer",
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

}
