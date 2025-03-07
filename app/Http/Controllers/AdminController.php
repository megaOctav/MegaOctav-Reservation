<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    
    public function index()
    {
        $admins = admin::all();

        return response()->json([
            'status' => 200,
            'message' => 'Admins retrieved successfully.',
            'data' => $admins
        ], 200);
    }

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
            'email_adm' => 'required|email|unique:admins',
            'phone_adm' => 'required|integer|min:6'
        ]);

        $admin->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Admin updated successfully.',
            'data' => $admin
        ], 200);
    }

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
