<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Login;

class LoginController extends Controller
{
    /**
     * @OA\Get(
     *     path="/logins",
     *     tags={"Login"},
     *     operationId="listLogins",
     *     summary="List of Logins",
     *     description="Retrieve a list of all login records",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Successfully retrieved logins",
     *                 "data": {
     *                     {
     *                         "Id_Login": 1,
     *                         "Username": "johndoe",
     *                         "Password": "hashed_password"
     *                     }
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $logins = Login::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved logins',
            'data' => $logins
        ]);
    }
}
