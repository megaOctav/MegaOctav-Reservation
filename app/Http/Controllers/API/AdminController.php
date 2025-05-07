<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;

class AdminController extends Controller
{
    /**
     * @OA\Get(
     *     path="/admin",
     *     tags={"Admin"},
     *     operationId="listAdmins",
     *     summary="List of Admins",
     *     description="Retrieve all admins",
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent(type="object")
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
        ]);
    }

    /**
     * @OA\Get(
     *     path="/admin/{id}",
     *     tags={"Admin"},
     *     summary="Get admin by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id)
    {
        $admin = admin::find($id);
        if (!$admin) {
            return response()->json(['status' => 404, 'message' => 'Admin not found'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Admin found', 'data' => $admin]);
    }

    /**
     * @OA\Post(
     *     path="/admin",
     *     tags={"Admin"},
     *     summary="Create a new admin",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"username_adm", "email_adm", "phone_adm"},
     *             @OA\Property(property="username_adm", type="string"),
     *             @OA\Property(property="email_adm", type="string"),
     *             @OA\Property(property="phone_adm", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=400, description="Bad Request")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'username_adm' => 'required|string|max:255',
            'email_adm' => 'required|email|unique:admins,email_adm',
            'phone_adm' => 'required|string|max:20'
        ]);

        $admin = admin::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Admin created successfully.',
            'data' => $admin
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/admin/{id}",
     *     tags={"Admin"},
     *     summary="Update an admin",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="username_adm", type="string"),
     *             @OA\Property(property="email_adm", type="string"),
     *             @OA\Property(property="phone_adm", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function update(Request $request, $id)
    {
        $admin = admin::find($id);
        if (!$admin) {
            return response()->json(['status' => 404, 'message' => 'Admin not found'], 404);
        }

        $admin->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Admin updated successfully.',
            'data' => $admin
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/admin/{id}",
     *     tags={"Admin"},
     *     summary="Delete an admin",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Deleted"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($id)
    {
        $admin = admin::find($id);
        if (!$admin) {
            return response()->json(['status' => 404, 'message' => 'Admin not found'], 404);
        }

        $admin->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Admin deleted successfully.'
        ]);
    }
}
