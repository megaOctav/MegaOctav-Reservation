<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

/**
 * @OA\Tag(
 *     name="Transactions",
 *     description="API untuk mengelola transaksi"
 * )
 */
class TransactionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/transactions",
     *     tags={"Transactions"},
     *     summary="Ambil semua transaksi",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil daftar transaksi",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="id_user", type="integer"),
     *                 @OA\Property(property="schedule_id", type="integer"),
     *                 @OA\Property(property="payment_method", type="string"),
     *                 @OA\Property(property="total_price", type="number"),
     *                 @OA\Property(property="payment_date", type="string", format="date"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Transaction::all();
    }

    /**
 * @OA\Post(
 *     path="/transactions",
 *     tags={"Transactions"},
 *     summary="Buat transaksi baru",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id_user", "schedule_id", "payment_method", "total_price", "payment_date"},
 *             @OA\Property(property="id_user", type="integer", example=1),
 *             @OA\Property(property="schedule_id", type="integer", example=2),
 *             @OA\Property(property="payment_method", type="string", example="gopay"),
 *             @OA\Property(property="total_price", type="number", example=100000),
 *             @OA\Property(property="payment_date", type="string", format="date", example="2025-05-21")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Transaksi berhasil dibuat",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=5),
 *             @OA\Property(property="id_user", type="integer", example=1),
 *             @OA\Property(property="schedule_id", type="integer", example=2),
 *             @OA\Property(property="payment_method", type="string", example="gopay"),
 *             @OA\Property(property="total_price", type="number", example=100000),
 *             @OA\Property(property="payment_date", type="string", format="date", example="2025-05-21"),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-22T10:00:00Z"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-22T10:00:00Z")
 *         )
 *     ),
 *     @OA\Response(response=400, description="Bad request")
 * )
 */
public function store(Request $request)
{
    $request->validate([
        'id_user' => 'required|exists:users,id',
        'schedule_id' => 'required|exists:schedules,id',
        'payment_method' => 'required|string',
        'total_price' => 'required|numeric',
        'payment_date' => 'required|date',
    ]);

    $transaction = Transaction::create($request->all());

    return response()->json($transaction, 201);
}

    /**
     * @OA\Get(
     *     path="/transactions/{id}",
     *     tags={"Transactions"},
     *     summary="Lihat transaksi berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail transaksi"
     *     ),
     *     @OA\Response(response=404, description="Transaksi tidak ditemukan")
     * )
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($transaction);
    }

    /**
     * @OA\Put(
     *     path="/transactions/{id}",
     *     tags={"Transactions"},
     *     summary="Update transaksi",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="payment_method", type="string", example="qris"),
     *             @OA\Property(property="total_price", type="number", example=120000),
     *             @OA\Property(property="payment_date", type="string", format="date", example="2025-05-22")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transaksi berhasil diupdate"
     *     ),
     *     @OA\Response(response=404, description="Transaksi tidak ditemukan")
     * )
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $transaction->update($request->all());

        return response()->json($transaction);
    }

    /**
     * @OA\Delete(
     *     path="/transactions/{id}",
     *     tags={"Transactions"},
     *     summary="Hapus transaksi",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Transaksi berhasil dihapus"
     *     ),
     *     @OA\Response(response=404, description="Transaksi tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $transaction->delete();

        return response()->json(null, 204);
    }
}
