<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/transactions",
     *     summary="Get all transactions",
     *     tags={"Transactions"},
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index()
    {
        return response()->json(Transaction::all());
    }

    /**
     * @OA\Post(
     *     path="/transactions",
     *     summary="Create transaction",
     *     tags={"Transactions"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_user","schedule_id","payment_method","total_price","payment_date"},
     *             @OA\Property(property="id_user", type="integer"),
     *             @OA\Property(property="schedule_id", type="integer"),
     *             @OA\Property(property="payment_method", type="string"),
     *             @OA\Property(property="total_price", type="number", format="float"),
     *             @OA\Property(property="payment_date", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Created")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|integer',
            'schedule_id' => 'required|integer',
            'payment_method' => 'required|string',
            'total_price' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        $transaction = Transaction::create($data);
        return response()->json($transaction, 201);
    }

    /**
     * @OA\Get(
     *     path="/transactions/{id}",
     *     summary="Get a single transaction",
     *     tags={"Transactions"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        return response()->json($transaction);
    }

    /**
     * @OA\Put(
     *     path="/transactions/{id}",
     *     summary="Update a transaction",
     *     tags={"Transactions"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_user", type="integer"),
     *             @OA\Property(property="schedule_id", type="integer"),
     *             @OA\Property(property="payment_method", type="string"),
     *             @OA\Property(property="total_price", type="number", format="float"),
     *             @OA\Property(property="payment_date", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Updated"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $data = $request->validate([
            'id_user' => 'sometimes|integer',
            'schedule_id' => 'sometimes|integer',
            'payment_method' => 'sometimes|string',
            'total_price' => 'sometimes|numeric',
            'payment_date' => 'sometimes|date',
        ]);

        $transaction->update($data);
        return response()->json($transaction);
    }

    /**
     * @OA\Delete(
     *     path="/transactions/{id}",
     *     summary="Delete a transaction",
     *     tags={"Transactions"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="204", description="Deleted"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();
        return response()->json(null, 204);
    }
}
