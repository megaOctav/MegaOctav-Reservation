<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Throwable;

class ScheduleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/schedules",
     *     tags={"Schedule"},
     *     summary="List all schedules",
     *     @OA\Response(response=200, description="List of schedules")
     * )
     */
    public function index()
    {
        $schedules = Schedule::with('film')->get();

        return response()->json([
            'success' => true,
            'message' => 'List of schedules',
            'data' => $schedules
        ]);
    }

    /**
     * @OA\Post(
     *     path="/schedules",
     *     tags={"Schedule"},
     *     summary="Create new schedule",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_film", "location_id", "playing_date", "playing_time"},
     *             @OA\Property(property="id_film", type="integer"),
     *             @OA\Property(property="location_id", type="integer"),
     *             @OA\Property(property="playing_date", type="string", format="date"),
     *             @OA\Property(property="playing_time", type="string", format="time")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Schedule created")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_film' => 'required|exists:films,id_film',
            'location_id' => 'required|integer',
            'playing_date' => 'required|date',
            'playing_time' => 'required|date_format:H:i:s',
        ]);

        $schedule = Schedule::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Schedule created successfully.',
            'data' => $schedule
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/schedules/{id}",
     *     tags={"Schedule"},
     *     summary="Get schedule by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Schedule data"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $schedule = Schedule::with('film')->find($id);
        if (!$schedule) {
            return response()->json(['status' => 404, 'message' => 'Schedule not found'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Schedule found', 'data' => $schedule]);
    }

    /**
     * @OA\Put(
     *     path="/schedules/{id}",
     *     tags={"Schedule"},
     *     summary="Update a schedule",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="id_film", type="integer"),
     *             @OA\Property(property="location_id", type="integer"),
     *             @OA\Property(property="playing_date", type="string", format="date"),
     *             @OA\Property(property="playing_time", type="string", format="time")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Schedule updated")
     * )
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'id_film' => 'required|exists:films,id_film',
            'location_id' => 'required|integer',
            'playing_date' => 'required|date',
            'playing_time' => 'required|date_format:H:i:s',
        ]);

        $schedule->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Schedule updated successfully.',
            'data' => $schedule
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/schedules/{id}",
     *     tags={"Schedule"},
     *     summary="Delete a schedule",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Schedule deleted")
     * )
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Schedule deleted successfully.'
        ]);
    }

}
