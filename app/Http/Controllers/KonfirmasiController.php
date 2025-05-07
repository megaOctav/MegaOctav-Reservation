<?php

namespace App\Http\Controllers;

use App\Models\Konfirmasi;
use Illuminate\Http\Request;

class KonfirmasiController extends Controller
{
    public function index()
    {
        $konfirmasis = Konfirmasi::all();

        return response()->json([
            'status' => 200,
            'message' => 'Konfirmasi retrieved successfully.',
            'data' => $konfirmasis
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_booking' => 'required|integer',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'total_payment' => 'required|numeric'
        ]);

        $konfirmasi = Konfirmasi::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Konfirmasi created successfully.',
            'data' => $konfirmasi
        ], 201);
    }

    public function show($id)
    {
        $konfirmasi = Konfirmasi::find($id);

        if (!$konfirmasi) {
            return response()->json([
                'status' => 404,
                'message' => 'Konfirmasi not found.',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Konfirmasi retrieved successfully.',
            'data' => $konfirmasi
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $konfirmasi = Konfirmasi::find($id);

        if (!$konfirmasi) {
            return response()->json([
                'status' => 404,
                'message' => 'Konfirmasi not found.',
            ], 404);
        }

        $request->validate([
            'id_booking' => 'required|integer',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'total_payment' => 'required|numeric'
        ]);

        $konfirmasi->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Konfirmasi updated successfully.',
            'data' => $konfirmasi
        ], 200);
    }

    public function destroy($id)
    {
        $konfirmasi = Konfirmasi::find($id);

        if (!$konfirmasi) {
            return response()->json([
                'status' => 404,
                'message' => 'Konfirmasi not found.',
            ], 404);
        }

        $konfirmasi->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Konfirmasi deleted successfully.',
        ], 200);
    }
}
