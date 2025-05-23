<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class PriceController extends Controller
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
     *     path="/prices",
     *     tags={"Price"},
     *     summary="List all prices",
     *     @OA\Response(response=200, description="List of prices")
     * )
     */
    public function index()
    {
        $prices = Price::with('film')->get();

        return response()->json([
            'success' => true,
            'message' => 'List of prices',
            'data' => $prices
        ]);
    }

    /**
     * @OA\Post(
     *     path="/prices",
     *     tags={"Price"},
     *     summary="Create new price",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"film_id", "day_type", "ticket_price"},
     *             @OA\Property(property="film_id", type="integer"),
     *             @OA\Property(property="day_type", type="string"),
     *             @OA\Property(property="ticket_price", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Price created")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'film_id' => 'required|exists:films,id_film',
            'day_type' => 'required|string|max:20',
            'ticket_price' => 'required|numeric',
        ]);

        $price = Price::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Price created successfully.',
            'data' => $price
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/prices/{id}",
     *     tags={"Price"},
     *     summary="Get price by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Price data"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $price = Price::with('film')->find($id);
        if (!$price) {
            return response()->json(['status' => 404, 'message' => 'Price not found'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Price found', 'data' => $price]);
    }

    /**
     * @OA\Put(
     *     path="/prices/{id}",
     *     tags={"Price"},
     *     summary="Update a price",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="film_id", type="integer"),
     *             @OA\Property(property="day_type", type="string"),
     *             @OA\Property(property="ticket_price", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Price updated")
     * )
     */
    public function update(Request $request, $id)
    {
        $price = Price::findOrFail($id);

        $validated = $request->validate([
            'film_id' => 'required|exists:films,id_film',
            'day_type' => 'required|string|max:20',
            'ticket_price' => 'required|numeric',
        ]);

        $price->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Price updated successfully.',
            'data' => $price
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/prices/{id}",
     *     tags={"Price"},
     *     summary="Delete a price",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Price deleted")
     * )
     */
    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Price deleted successfully.'
        ]);
    }
}
