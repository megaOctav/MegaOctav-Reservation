<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Admin API",
 *     version="1.0.0"
 * )
 *
 * @OA\Tag(
 *     name="Admin",
 *     description="API untuk manajemen data admin"
 * )
 */
class AdminController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/admins",
     *     tags={"Admin"},
     *     summary="Menampilkan semua admin",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data admin"
     *     )
     * )
     */
    public function index()
    {
        $admins = admin::all();

        return response()->json([
            'status' => 200,
            'message' => 'Admins retrieved successfully.',
            'data' => $admins
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/admins",
     *     tags={"Admin"},
     *     summary="Menambahkan admin baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"username_adm", "email_adm", "phone_adm"},
     *             @OA\Property(property="username_adm", type="string", example="admin123"),
     *             @OA\Property(property="email_adm", type="string", format="email", example="admin@mail.com"),
     *             @OA\Property(property="phone_adm", type="integer", example=12345678)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Admin berhasil ditambahkan"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'username_adm' => 'required|string',
            'email_adm' => 'required|email|unique:admins',
            'phone_adm' => 'required|integer|min:6'
        ]);

        $admin = admin::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Admin created successfully',
            'data' => $admin
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/admins/{id}",
     *     tags={"Admin"},
     *     summary="Menampilkan detail admin berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin ditemukan"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Admin tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        $admin = admin::find($id);

        if (!$admin) {
            return response()->json([
                'status' => 404,
                'message' => 'Admin Not Found',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Admin retrieved successfully.',
            'data' => $admin
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/admins/{id}",
     *     tags={"Admin"},
     *     summary="Update admin berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"username_adm", "email_adm", "phone_adm"},
     *             @OA\Property(property="username_adm", type="string", example="adminbaru"),
     *             @OA\Property(property="email_adm", type="string", format="email", example="newadmin@mail.com"),
     *             @OA\Property(property="phone_adm", type="integer", example=87654321)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin berhasil diupdate"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Admin tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $admin = admin::find($id);

        if (!$admin) {
            return response()->json([
                'status' => 404,
                'message' => 'Admin not found.',
            ], 404);
        }

        $request->validate([
            'username_adm' => 'required|string',
            'email_adm' => 'required|email|unique:admins,email_adm,' . $id,
            'phone_adm' => 'required|integer|min:6'
        ]);

        $admin->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Admin updated successfully.',
            'data' => $admin
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/admins/{id}",
     *     tags={"Admin"},
     *     summary="Hapus admin berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Admin tidak ditemukan"
     *     )
     * )
     */
    public function destroy($id)
    {
        $admin = admin::find($id);

        if (!$admin) {
            return response()->json([
                'status' => 404,
                'message' => 'Admin not found.',
            ], 404);
        }

        $admin->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Admin deleted successfully.',
        ], 200);
    }
}
