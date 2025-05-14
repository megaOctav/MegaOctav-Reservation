<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konfirmasi;

class KonfirmasiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/konfirmasi",
     *     tags={"Konfirmasi"},
     *     summary="List of Konfirmasi",
     *     description="Retrieve all konfirmasi records",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Konfirmasi retrieved successfully."),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="id_booking", type="integer", example=101),
     *                     @OA\Property(property="payment_method", type="string", example="credit card"),
     *                     @OA\Property(property="payment_status", type="string", example="paid"),
     *                     @OA\Property(property="total_payment", type="number", format="float", example=500.00),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $konfirmasi = Konfirmasi::all();

        return response()->json([
            'status' => 200,
            'message' => 'Konfirmasi retrieved successfully.',
            'data' => $konfirmasi
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/konfirmasi",
     *     tags={"Konfirmasi"},
     *     summary="Create a new konfirmasi",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_booking", "payment_method", "payment_status", "total_payment"},
     *             @OA\Property(property="id_booking", type="integer", example=101),
     *             @OA\Property(property="payment_method", type="string", example="credit card"),
     *             @OA\Property(property="payment_status", type="string", example="paid"),
     *             @OA\Property(property="total_payment", type="number", format="float", example=500.00)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Konfirmasi created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=201),
     *             @OA\Property(property="message", type="string", example="Konfirmasi created successfully."),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_booking' => 'required|integer',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'total_payment' => 'required|numeric'
        ]);

        $konfirmasi = Konfirmasi::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Konfirmasi created successfully.',
            'data' => $konfirmasi
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/konfirmasi/{id}",
     *     tags={"Konfirmasi"},
     *     summary="Update konfirmasi",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="payment_method", type="string", example="credit card"),
     *             @OA\Property(property="payment_status", type="string", example="paid"),
     *             @OA\Property(property="total_payment", type="number", format="float", example=500.00)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Konfirmasi updated successfully"),
     *     @OA\Response(response=404, description="Konfirmasi not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $konfirmasi = Konfirmasi::find($id);

        if (!$konfirmasi) {
            return response()->json([
                'status' => 404,
                'message' => 'Konfirmasi not found.'
            ], 404);
        }

        $konfirmasi->update($request->only(['payment_method', 'payment_status', 'total_payment']));

        return response()->json([
            'status' => 200,
            'message' => 'Konfirmasi updated successfully.',
            'data' => $konfirmasi
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/konfirmasi/{id}",
     *     tags={"Konfirmasi"},
     *     summary="Delete konfirmasi",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Konfirmasi deleted successfully"),
     *     @OA\Response(response=404, description="Konfirmasi not found")
     * )
     */
    public function destroy($id)
    {
        $konfirmasi = Konfirmasi::find($id);

        if (!$konfirmasi) {
            return response()->json([
                'status' => 404,
                'message' => 'Konfirmasi not found.'
            ], 404);
        }

        $konfirmasi->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Konfirmasi deleted successfully.'
        ]);
    }
}
