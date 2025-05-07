<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konfirmasi;

class KonfirmasiController extends Controller
{
   /**
    * @OA\Put(
    *     path="/konfirmasi/{id}",
    *     tags={"Konfirmasi"},
    *     operationId="konfirmasi",
    *     summary="Konfirmasi",
    *     description="Mengubah status konfirmasi",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID konfirmasi yang akan dikonfirmasi",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Berhasil konfirmasi",
    *         @OA\JsonContent(
    *             example={
    *                 "status": 200,
    *                 "message": "Berhasil konfirmasi.",
    *                 "data": {
    *                     "id": 1,
    *                     "id_booking": 101,
    *                     "payment_method": "credit card",
    *                     "payment_status": "paid",
    *                     "total_payment": 500.00,
    *                     "created_at": "2025-04-30T08:00:00Z",
    *                     "updated_at": "2025-04-30T08:00:00Z"
    *                 }
    *             }
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Konfirmasi tidak ditemukan",
    *         @OA\JsonContent(
    *             example={
    *                 "status": 404,
    *                 "message": "Konfirmasi tidak ditemukan."
    *             }
    *         )
    *     )
    * )
    */
   public function konfirmasi($id)
   {
       $konfirmasi = Konfirmasi::find($id);

       if (!$konfirmasi) {
           return response()->json([
               'status' => 404,
               'message' => 'Konfirmasi tidak ditemukan.'
           ], 404);
       }

       $konfirmasi->payment_status = 'confirmed';
       $konfirmasi->save();

       return response()->json([
           'status' => 200,
           'message' => 'Berhasil konfirmasi.',
           'data' => $konfirmasi
       ], 200);
   }
}
