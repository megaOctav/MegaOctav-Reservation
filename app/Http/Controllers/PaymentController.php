<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\payment;

class PaymentController extends Controller
{
    //
    public function index()
    {
        $payments = payment::all();

        return response()->json([
            'status' => 200,
            'message' => 'Payments retrieved successfully.',
            'data' => $payments
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'required|integer',
            'id_product' => 'required|integer',
            'total' => 'required|integer',
            'status' => 'required|string',
        ]);

        $payment = payment::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Payment created successfully.',
            'data' => $payment
        ], 201);
    }

    public function show($id)
    {
        $payment = payment::find($id);

        if (!$payment) {
            return response()->json([
                'status' => 404,
                'message' => 'Payment not found.',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Payment retrieved successfully.',
            'data' => $payment
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $payment = payment::find($id);

        if (!$payment) {
            return response()->json([
                'status' => 404,
                'message' => 'Payment not found.',
            ], 404);
        }

        $request->validate([
            'id_customer' => 'required|integer',
            'id_product' => 'required|integer',
            'total' => 'required|integer',
            'status' => 'required|string',
        ]);

        $payment->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Payment updated successfully.',
            'data' => $payment
        ], 200);
    }

    public function destroy($id)
    {
        $payment = payment::find($id);

        if (!$payment) {
            return response()->json([
                'status' => 404,
                'message' => 'Payment not found.',
            ], 404);
        }

        $payment->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Payment deleted successfully.',
        ], 200);
    }
}
