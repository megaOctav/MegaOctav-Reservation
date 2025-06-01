<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="User",
 *     description="API untuk operasi data user (admin & pengunjung)"
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
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    /**
     * @OA\Post(
     *     path="/users",
     *     tags={"User"},
     *     summary="Tambah user baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "role"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="role", type="string", example="admin")
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
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|in:admin,pengunjung'
        ]);

        $user = User::create($request->only('name', 'email', 'role'));

        return response()->json(['message' => 'User berhasil ditambahkan', 'data' => $user], 201);
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
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="role", type="string", example="pengunjung")
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
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'role'  => 'sometimes|in:admin,pengunjung'
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return response()->json(['message' => "User berhasil diupdate", 'data' => $user], 200);
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
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => "User dengan ID $id berhasil dihapus"], 200);
    }

    /**
     * @OA\Get(
     *     path="/users/role/{role}",
     *     tags={"User"},
     *     summary="Ambil user berdasarkan role",
     *     @OA\Parameter(
     *         name="role",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", enum={"admin", "pengunjung"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil ambil user berdasarkan role"
     *     )
     * )
     */
    public function getByRole($role)
    {
        $users = User::where('role', $role)->get();
        return response()->json(['data' => $users], 200);
    }
}
