<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/transactions",
     *     tags={"Transaction"},
     *     summary="List all transactions",
     *     @OA\Response(response=200, description="List of transactions")
     * )
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'schedule'])->get();

        return response()->json([
            'success' => true,
            'message' => 'List of transactions',
            'data' => $transactions
        ]);
    }

    /**
     * @OA\Post(
     *     path="/transactions",
     *     tags={"Transaction"},
     *     summary="Create new transaction",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_user", "schedule_id", "payment_method", "total_price", "payment_date"},
     *             @OA\Property(property="id_user", type="integer"),
     *             @OA\Property(property="schedule_id", type="integer"),
     *             @OA\Property(property="payment_method", type="string"),
     *             @OA\Property(property="total_price", type="number", format="float"),
     *             @OA\Property(property="payment_date", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Transaction created")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'schedule_id' => 'required|exists:schedules,id_schedule',
            'payment_method' => 'required|string',
            'total_price' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        $transaction = Transaction::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Transaction created successfully.',
            'data' => $transaction
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/transactions/{id}",
     *     tags={"Transaction"},
     *     summary="Get transaction by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Transaction data"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $transaction = Transaction::with(['user', 'schedule'])->find($id);

        if (!$transaction) {
            return response()->json(['status' => 404, 'message' => 'Transaction not found'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Transaction found', 'data' => $transaction]);
    }

    /**
     * @OA\Put(
     *     path="/transactions/{id}",
     *     tags={"Transaction"},
     *     summary="Update a transaction",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="id_user", type="integer"),
     *             @OA\Property(property="schedule_id", type="integer"),
     *             @OA\Property(property="payment_method", type="string"),
     *             @OA\Property(property="total_price", type="number", format="float"),
     *             @OA\Property(property="payment_date", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Transaction updated")
     * )
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'schedule_id' => 'required|exists:schedules,id_schedule',
            'payment_method' => 'required|string',
            'total_price' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        $transaction->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Transaction updated successfully.',
            'data' => $transaction
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/transactions/{id}",
     *     tags={"Transaction"},
     *     summary="Delete a transaction",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Transaction deleted")
     * )
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Transaction deleted successfully.'
        ]);
    }
}
