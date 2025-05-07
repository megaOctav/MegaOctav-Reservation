<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="User",
 *     description="API untuk manajemen data user"
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"User"},
     *     summary="Ambil daftar semua user",
     *     @OA\Response(response=200, description="Berhasil")
     * )
     */
    public function index()
    {
        return response()->json(["message" => "Daftar user"], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"User"},
     *     summary="Tambahkan user baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email")
     *         )
     *     ),
     *     @OA\Response(response=201, description="User berhasil dibuat")
     * )
     */
    public function store(Request $request)
    {
        return response()->json(["message" => "User dibuat"], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"User"},
     *     summary="Perbarui user berdasarkan ID",
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
     *     @OA\Response(response=200, description="User diperbarui")
     * )
     */
    public function update(Request $request, $id)
    {
        return response()->json(["message" => "User diperbarui: $id"], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"User"},
     *     summary="Hapus user berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="User dihapus")
     * )
     */
    public function destroy($id)
    {
        return response()->json(["message" => "User dihapus: $id"], 200);
    }
}
