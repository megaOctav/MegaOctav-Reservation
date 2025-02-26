<?php

namespace App\Http\Controllers;

use App\Models\booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function index()
    {
        $bookings = booking::all();

        return response()->json([
            'status' => 200,
            'message' => 'Bookings retrieved successfully.',
            'data' => $bookings
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'required|integer',
            'booking_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $booking = booking::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Booking created successfully.',
            'data' => $booking
        ], 201);
    }

    public function show($id)
    {
        $booking = booking::find($id);

        if (!$booking) {
            return response()->json([
                'status' => 404,
                'message' => 'Booking not found.',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Booking retrieved successfully.',
            'data' => $booking
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $booking = booking::find($id);

        if (!$booking) {
            return response()->json([
                'status' => 404,
                'message' => 'Booking not found.',
            ], 404);
        }

        $request->validate([
            'id_customer' => 'required|integer',
            'booking_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $booking->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Booking updated successfully.',
            'data' => $booking
        ], 200);
    }

    public function destroy($id)
    {
        $booking = booking::find($id);

        if (!$booking) {
            return response()->json([
                'status' => 404,
                'message' => 'Booking not found.',
            ], 404);
        }

        $booking->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Booking deleted successfully.',
        ], 200);
    }
}
