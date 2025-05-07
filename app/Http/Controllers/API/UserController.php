<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; // penting!
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="User",
 *     description="API untuk operasi data user"
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users",
     *     tags={"User"},
     *     summary="Ambil semua user",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil ambil data user"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(['message' => 'Semua user'], 200);
    }

    /**
     * @OA\Post(
     *     path="/users",
     *     tags={"User"},
     *     summary="Tambah user baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User berhasil dibuat"
     *     )
     * )
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'User berhasil ditambahkan'], 201);
    }

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     tags={"User"},
     *     summary="Update user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User berhasil diupdate"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => "User dengan ID $id berhasil diupdate"], 200);
    }

    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     tags={"User"},
     *     summary="Hapus user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User berhasil dihapus"
     *     )
     * )
     */
    public function destroy($id)
    {
        return response()->json(['message' => "User dengan ID $id berhasil dihapus"], 200);
    }
}
