<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class SeatsController extends Controller
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation failed.',
                'errors' => $exception->errors(),
            ], 422);
        }

        return parent::render($request, $exception);
    }

    /**
     * @OA\Get(
     *     path="/api/seats",
     *     tags={"Seat"},
     *     summary="List all seats",
     *     @OA\Response(response=200, description="List of seats")
     * )
     */
    public function index()
    {
        $seats = Seat::with('schedule')->get(); // asumsi seats memiliki relasi 'schedule'

        return response()->json([
            'success' => true,
            'message' => 'List of seats',
            'data' => $seats
        ]);
    }

    /**
     * @OA\Post(
     *     path="/seats",
     *     tags={"Seat"},
     *     summary="Create new seat",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"schedule_id", "number", "status_seats"},
     *             @OA\Property(property="schedule_id", type="integer"),
     *             @OA\Property(property="number", type="string"),
     *             @OA\Property(property="status_seats", type="string", enum={"available", "booked"})
     *         )
     *     ),
     *     @OA\Response(response=201, description="Seat created")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,schedule_id',
            'number' => 'required|string',
            'status_seats' => 'required|in:available,booked',
        ]);

        $seat = Seat::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Seat created successfully.',
            'data' => $seat
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/seats/{id}",
     *     tags={"Seat"},
     *     summary="Get seat by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Seat found"),
     *     @OA\Response(response=404, description="Seat not found")
     * )
     */
    public function show($id)
    {
        $seat = Seat::with('schedule')->find($id);
        if (!$seat) {
            return response()->json(['status' => 404, 'message' => 'Seat not found'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Seat found', 'data' => $seat]);
    }

    /**
     * @OA\Put(
     *     path="/seats/{id}",
     *     tags={"Seat"},
     *     summary="Update a seat",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="schedule_id", type="integer"),
     *             @OA\Property(property="number", type="string"),
     *             @OA\Property(property="status_seats", type="string", enum={"available", "booked"})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Seat updated")
     * )
     */
    public function update(Request $request, $id)
    {
        $seat = Seat::find($id);
        if (!$seat) {
            return response()->json(['status' => 404, 'message' => 'Seat not found'], 404);
        }

        $validated = $request->validate([
            'schedule_id' => 'sometimes|exists:schedules,schedule_id',
            'number' => 'sometimes|string',
            'status_seats' => 'sometimes|in:available,booked',
        ]);

        $seat->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Seat updated successfully.',
            'data' => $seat
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/seats/{id}",
     *     tags={"Seat"},
     *     summary="Delete a seat",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Seat deleted")
     * )
     */
    public function destroy($id)
    {
        $seat = Seat::find($id);
        if (!$seat) {
            return response()->json(['status' => 404, 'message' => 'Seat not found'], 404);
        }

        $seat->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Seat deleted successfully.'
        ]);
    }
}
