<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FilmController extends Controller
{
    /**
     * @OA\Get(
     *     path="/films",
     *     tags={"Film"},
     *     summary="List all films",
     *     @OA\Response(
     *         response=200,
     *         description="List of films",
     *         @OA\JsonContent()
     *     )
     * )
     */
    public function index()
    {
        $films = Film::all();

        return response()->json([
            'success' => true,
            'message' => 'List of films',
            'data' => $films
        ]);
    }

    /**
     * @OA\Post(
     *     path="/films",
     *     tags={"Film"},
     *     summary="Add a new film",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"film_title", "synopsis", "genre", "duration", "rating_film"},
     *             @OA\Property(property="film_title", type="string"),
     *             @OA\Property(property="synopsis", type="string"),
     *             @OA\Property(property="genre", type="string"),
     *             @OA\Property(property="duration", type="integer"),
     *             @OA\Property(property="rating_film", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Film created"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'film_title' => 'required|string',
            'synopsis' => 'required|string',
            'genre' => 'required|string',
            'duration' => 'required|integer',
            'rating_film' => 'required|integer',
        ]);

        $film = Film::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Film created successfully.',
            'data' => $film
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/films/{id}",
     *     tags={"Film"},
     *     summary="Get film by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Film data"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $film = Film::find($id);
        if (!$film) {
            return response()->json(['status' => 404, 'message' => 'Film not found'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Film found', 'data' => $film]);
    }

    /**
     * @OA\Put(
     *     path="/films/{id}",
     *     tags={"Film"},
     *     summary="Update film data",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="film_title", type="string"),
     *             @OA\Property(property="synopsis", type="string"),
     *             @OA\Property(property="genre", type="string"),
     *             @OA\Property(property="duration", type="integer"),
     *             @OA\Property(property="rating_film", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Film updated")
     * )
     */
    public function update(Request $request, $id)
    {
        $film = Film::findOrFail($id);

        $validated = $request->validate([
            'film_title' => 'required|string',
            'synopsis' => 'required|string',
            'genre' => 'required|string',
            'duration' => 'required|integer',
            'rating_film' => 'required|integer'
        ]);

        $film->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Film updated successfully.',
            'data' => $film
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/films/{id}",
     *     tags={"Film"},
     *     summary="Delete a film",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Film deleted")
     * )
     */
    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Film deleted successfully.'
        ]);
    }
}
