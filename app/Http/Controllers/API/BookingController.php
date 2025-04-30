<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/booking",
     *     tags={"Booking"},
     *     operationId="listBookings",
     *     summary="List of Bookings",
     *     description="Retrieve a list of bookings",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Bookings retrieved successfully.",
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "id_customer": 101,
     *                         "booking_date": "2025-04-30",
     *                         "status": "confirmed",
     *                         "created_at": "2025-04-30T08:00:00Z",
     *                         "updated_at": "2025-04-30T08:00:00Z"
     *                     },
     *                     {
     *                         "id": 2,
     *                         "id_customer": 102,
     *                         "booking_date": "2025-05-01",
     *                         "status": "pending",
     *                         "created_at": "2025-04-30T09:00:00Z",
     *                         "updated_at": "2025-04-30T09:00:00Z"
     *                     }
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $bookings = Booking::all();

        return response()->json([
            'status' => 200,
            'message' => 'Bookings retrieved successfully.',
            'data' => $bookings
        ], 200);
    }
}
