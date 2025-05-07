<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/payments",
     *     tags={"Payment"},
     *     operationId="listPayments",
     *     summary="List of Payments",
     *     description="Retrieve a list of all payments",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Successfully retrieved payments",
     *                 "data": {}
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $payments = payment::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved payments',
            'data' => $payments
        ]);
    }

    /**
     * @OA\Get(
     *     path="/payments/{id}",
     *     tags={"Payment"},
     *     operationId="getPaymentById",
     *     summary="Get Payment by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the payment",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Payment retrieved successfully",
     *                 "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(response=404, description="Payment not found")
     * )
     */
    public function show($id)
    {
        $payment = payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Payment retrieved successfully',
            'data' => $payment
        ]);
    }

    /**
     * @OA\Put(
     *     path="/payments/{id}",
     *     tags={"Payment"},
     *     operationId="updatePayment",
     *     summary="Update a Payment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Payment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount", "payment_date", "method", "customer_id"},
     *             @OA\Property(property="amount", type="number", example=150000),
     *             @OA\Property(property="payment_date", type="string", format="date-time", example="2025-04-30T10:00:00Z"),
     *             @OA\Property(property="method", type="string", example="Transfer Bank"),
     *             @OA\Property(property="customer_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Payment updated successfully"),
     *     @OA\Response(response=404, description="Payment not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $payment = payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found',
            ], 404);
        }

        $payment->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Payment updated successfully',
            'data' => $payment
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/payments/{id}",
     *     tags={"Payment"},
     *     operationId="deletePayment",
     *     summary="Delete a Payment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Payment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Payment deleted successfully"),
     *     @OA\Response(response=404, description="Payment not found")
     * )
     */
    public function destroy($id)
    {
        $payment = payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found',
            ], 404);
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payment deleted successfully',
        ]);
    }
}
