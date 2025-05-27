<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class LocationController extends Controller
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
     *     path="/locations",
     *     tags={"Location"},
     *     summary="List all Location",
     *     @OA\Response(response=200, description="List of location")
     * )
     */
    public function index()
    {
        $locations = Location::all();

        return response()->json([
            'success' => true,
            'message' => 'List of locations',
            'data' => $locations
        ]);
    }

    /**
     * @OA\Post(
     *     path="/locations",
     *     tags={"Location"},
     *     summary="Create new Location",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"city", "theater_name", "theater_address"},
     *             @OA\Property(property="city", type="string"),
     *             @OA\Property(property="theater_name", type="string"),
     *             @OA\Property(property="theater_address", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Location created")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string',
            'theater_name' => 'required|string',
            'theater_address' => 'required|string',
        ]);

        $locations = Location::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Location created successfully.',
            'data' => $locations
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/locations/{id}",
     *     tags={"Location"},
     *     summary="Get location by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Location data"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $locations = Location::with('film')->find($id);
        if (!$locations) {
            return response()->json(['status' => 404, 'message' => 'Location not found'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Location found', 'data' => $locations]);
    }

    /**
     * @OA\Put(
     *     path="/locations/{id}",
     *     tags={"Location"},
     *     summary="Update a location",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="city", type="string"),
     *             @OA\Property(property="theater_name", type="string"),
     *             @OA\Property(property="theater_address", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Location updated")
     * )
     */
    public function update(Request $request, $id)
    {
        $locations = Location::findOrFail($id);

        $validated = $request->validate([
            'city' => 'required|string',
            'theater_name' => 'required|string',
            'theater_address' => 'required|string',
        ]);

        $locations->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Location updated successfully.',
            'data' => $locations
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/locations/{id}",
     *     tags={"Location"},
     *     summary="Delete a location",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Price deleted")
     * )
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Location deleted successfully.'
        ]);
    }
}
