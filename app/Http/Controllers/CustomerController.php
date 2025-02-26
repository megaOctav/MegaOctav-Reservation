<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customers = customer::all();

        return response()->json([
            'status' => 200,
            'message' => 'Customers retrieved successfully.',
            'data' => $customers
        ], 200);
    }

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
