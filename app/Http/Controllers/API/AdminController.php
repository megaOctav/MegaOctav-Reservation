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
     *     summary="List of Admin",
     *     description="Retrieve a list of admins",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Admins retrieved successfully.",
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "username_adm": 101,
     *                         "email_adm": "shena@dewacode.com",
     *                         "phone_adm": "12345670",
     *                         "created_at": "2025-04-30T08:00:00Z",
     *                         "updated_at": "2025-04-30T08:00:00Z"
     *                     },
     *                     {
     *                         "id": 2,
     *                         "username_adm": 102,
     *                         "email_adm": "windsor@dewacode.com",
     *                         "phone_adm": "12345679",
     *                         "created_at": "2025-04-30T08:00:00Z",
     *                         "updated_at": "2025-04-30T08:00:00Z"
     *                     }
     *                 }
     *             }
     *         )
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
}