<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Payment",
 *     description="API untuk operasi CRUD pembayaran"
 * )
 */
class PaymentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/payments",
     *     tags={"Payment"},
     *     summary="Menampilkan semua data pembayaran",
     *     @OA\Response(
     *         response=200,
     *         description="Payments retrieved successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Payments retrieved successfully.",
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "id_customer": 1,
     *                         "id_product": 2,
     *                         "total": 50000,
     *                         "status": "completed"
     *                     }
     *                 }
     *             }
     *         )
     *     )
     * )
     */

    /**
     * @OA\Post(
     *     path="/api/payments",
     *     tags={"Payment"},
     *     summary="Membuat pembayaran baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_customer", "id_product", "total", "status"},
     *             @OA\Property(property="id_customer", type="integer"),
     *             @OA\Property(property="id_product", type="integer"),
     *             @OA\Property(property="total", type="integer"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Payment created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 201,
     *                 "message": "Payment created successfully.",
     *                 "data": {
     *                     "id": 1,
     *                     "id_customer": 1,
     *                     "id_product": 2,
     *                     "total": 50000,
     *                     "status": "completed"
     *                 }
     *             }
     *         )
     *     )
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/payments/{id}",
     *     tags={"Payment"},
     *     summary="Menampilkan detail pembayaran berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment retrieved successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Payment retrieved successfully.",
     *                 "data": {
     *                     "id": 1,
     *                     "id_customer": 1,
     *                     "id_product": 2,
     *                     "total": 50000,
     *                     "status": "completed"
     *                 }
     *             }
     *         )
     *     ),
     *     @OA\Response(response=404, description="Payment not found")
     * )
     */

    /**
     * @OA\Put(
     *     path="/api/payments/{id}",
     *     tags={"Payment"},
     *     summary="Memperbarui data pembayaran berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_customer", "id_product", "total", "status"},
     *             @OA\Property(property="id_customer", type="integer"),
     *             @OA\Property(property="id_product", type="integer"),
     *             @OA\Property(property="total", type="integer"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Payment updated successfully"),
     *     @OA\Response(response=404, description="Payment not found")
     * )
     */

    /**
     * @OA\Delete(
     *     path="/api/payments/{id}",
     *     tags={"Payment"},
     *     summary="Menghapus data pembayaran berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Payment deleted successfully"),
     *     @OA\Response(response=404, description="Payment not found")
     * )
     */
}
