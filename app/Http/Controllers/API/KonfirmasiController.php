<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\booking;

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
     *                     }
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $bookings = booking::all();

        return response()->json([
            'status' => 200,
            'message' => 'Bookings retrieved successfully.',
            'data' => $bookings
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/booking",
     *     tags={"Booking"},
     *     summary="Create a new booking",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_customer", "booking_date", "status"},
     *             @OA\Property(property="id_customer", type="integer"),
     *             @OA\Property(property="booking_date", type="string", format="date"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Booking created successfully")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_customer' => 'required|integer',
            'booking_date' => 'required|date',
            'status' => 'required|string'
        ]);

        $booking = booking::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Booking created successfully.',
            'data' => $booking
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/booking/{id}",
     *     tags={"Booking"},
     *     summary="Update a booking",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_customer", type="integer"),
     *             @OA\Property(property="booking_date", type="string", format="date"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Booking updated successfully")
     * )
     */
    public function update(Request $request, $id)
    {
        $booking = booking::findOrFail($id);

        $booking->update($request->only(['id_customer', 'booking_date', 'status']));

        return response()->json([
            'status' => 200,
            'message' => 'Booking updated successfully.',
            'data' => $booking
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/booking/{id}",
     *     tags={"Booking"},
     *     summary="Delete a booking",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Booking deleted successfully")
     * )
     */
    public function destroy($id)
    {
        $booking = booking::findOrFail($id);
        $booking->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Booking deleted successfully.'
        ]);
    }
}
