<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\payment;

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
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "amount": 150000,
     *                         "payment_date": "2025-04-30T10:00:00Z",
     *                         "method": "Transfer Bank",
     *                         "customer_id": 1,
     *                         "created_at": "2025-04-30T10:00:00Z",
     *                         "updated_at": "2025-04-30T10:00:00Z"
     *                     }
     *                 }
     *             }
     *         )
     *     )
     * )
     * 
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
}
