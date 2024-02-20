<?php

namespace App\Http\Controllers;

use App\Models\PaketModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.v_admin');
    }

    public function indexPaket()
    {
        return view('admin.v_paket');
    }

    public function indexCustomer()
    {
        return view('admin.v_customer');
    }

    public function getDataPaket()
    {
        $paket = PaketModel::all();
        return response()->json([
            'status' => true,
            'message' => 'All Data Paket',
            'data' => $paket
        ], 200);
    }
    public function storePaket(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'harga' => 'required'
        ]);

        try {
            $paket = PaketModel::create($validated);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Paket Gagal Ditambahkan',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Paket Berhasil Ditambahkan',
            'data' => $paket
        ], 200);
    }

    public function updatePaket(Request $request, $id_paket)
    {
        $paket = PaketModel::find($id_paket);
        if (!$paket) {
            return response()->json([
                'status' => false,
                'message' => 'Paket: ' . $id_paket . ' Tidak Ada',
                'data' => []
            ], 404);
        }
        try {
            $paket->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Paket Gagal Diubah',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Paket Berhasil Diubah',
            'data' => $paket
        ], 200);
    }

    public function deletePaket($id_paket)
    {
        $paket = PaketModel::find($id_paket);
        if (!$paket) {
            return response()->json([
                'status' => false,
                'message' => 'Paket: ' . $id_paket . ' Tidak Ada',
                'data' => []
            ], 404);
        }
        try {
            $paket->delete();
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Paket Gagal Dihapus',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Paket Berhasil Dihapus',
            'data' => []
        ], 200);
    }

    
}
