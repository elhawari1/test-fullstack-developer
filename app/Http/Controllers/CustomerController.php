<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\File;


class CustomerController extends Controller
{
    public function getDataCustomer(Request $request)
    {
        $customer = CustomerModel::query();

        // Ubah kondisi di sini untuk memuat relasi jika diperlukan
        if ($request->withCustomerModel) {
            $customer = $customer->with('paket');
        }

        $customer = $customer->get();

        return response()->json([
            'status' => true,
            'message' => 'All Data Paket',
            'data' => $customer
        ], 200);
    }

    public function show(Request $request, $id_customer)
    {
        try {
            $customer = CustomerModel::query()->find($id_customer);
            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Customer dengan ID ' . $id_customer . ' tidak ditemukan',
                    'data' => []
                ], 404);
            }
            if ($request->withCustomerModel) {
                $customer = $customer->with('paket');
            }
            $customer = $customer->get();

            return response()->json([
                'status' => true,
                'message' => 'Data Customer: ' . $customer->first()->nama, // Sesuaikan dengan kebutuhan Anda
                'data' => $customer
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mendapatkan data customer',
                'data' => $e->getMessage()
            ], 500);
        }
    }



    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'id_paket' => 'required',
            'foto_ktp' => 'required|mimes:jpg,jpeg,png',
            'foto_rumah' => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('foto_ktp')) {
            $file_ktp = $request->file('foto_ktp');
            $ktp_extensions = $file_ktp->extension();
            $foto_ktp = $request->nama . "." . $ktp_extensions;
            $file_ktp->move(public_path('image_customer/ktp'), $foto_ktp);
        }
        if ($request->hasFile('foto_rumah')) {
            $file_rumah = $request->file('foto_rumah');
            $rumah_extensions = $file_rumah->extension();
            $foto_rumah = $request->nama . "_" . $request->alamat . "." . $rumah_extensions;
            $file_rumah->move(public_path('image_customer/rumah'), $foto_rumah);
        }

        try {
            $customer = new CustomerModel([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'id_paket' => $request->id_paket,
                'foto_ktp' => $foto_ktp,
                'foto_rumah' => $foto_rumah,
            ]);
            $customer->save();
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
            'data' => $customer
        ], 200);

    }

    public function update(Request $request, $id_customer)
    {
        try {
            $customer = CustomerModel::find($id_customer);

            // Update customer data
            $customerData = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'id_paket' => $request->id_paket,
            ];

            // Check if 'foto_ktp' is uploaded
            if ($request->hasFile('foto_ktp')) {
                $request->validate([
                    'foto_ktp' => 'mimes:jpg,jpeg,png',
                ]);

                // Delete old 'foto_ktp' if exists
                if ($customer->foto_ktp && File::exists(public_path('image_customer/ktp/' . $customer->foto_ktp))) {
                    File::delete(public_path('image_customer/ktp/' . $customer->foto_ktp));
                }

                // Upload new 'foto_ktp'
                $file_ktp = $request->file('foto_ktp');
                $foto_ktp = $request->nama . "." . $file_ktp->getClientOriginalExtension();
                $file_ktp->move(public_path('image_customer/ktp'), $foto_ktp);

                // Add 'foto_ktp' to customer data
                $customerData['foto_ktp'] = $foto_ktp;
            }

            // Check if 'foto_rumah' is uploaded
            if ($request->hasFile('foto_rumah')) {
                $request->validate([
                    'foto_rumah' => 'mimes:jpg,jpeg,png',
                ]);

                // Delete old 'foto_rumah' if exists
                if ($customer->foto_rumah && File::exists(public_path('image_customer/rumah/' . $customer->foto_rumah))) {
                    File::delete(public_path('image_customer/rumah/' . $customer->foto_rumah));
                }

                // Upload new 'foto_rumah'
                $file_rumah = $request->file('foto_rumah');
                $foto_rumah = $request->nama . "_" . $request->alamat . "." . $file_rumah->getClientOriginalExtension();
                $file_rumah->move(public_path('image_customer/rumah'), $foto_rumah);

                // Add 'foto_rumah' to customer data
                $customerData['foto_rumah'] = $foto_rumah;
            }

            // Update customer
            $customer->update($customerData);

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
            'data' => $customer
        ], 200);
    }

    public function delete($id_customer)
    {
        $customer = CustomerModel::find($id_customer);
        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Customer: ' . $id_customer . ' Tidak Ada',
                'data' => []
            ], 404);
        }
        if (File::exists('image_customer/ktp' . '/' . $customer->foto_ktp) && File::exists('image_customer/rumah' . '/' . $customer->foto_rumah)) {
            File::delete('image_customer/ktp' . '/' . $customer->foto_ktp);
            File::delete('image_customer/rumah' . '/' . $customer->foto_rumah);
        }
        try {
            $customer->delete();
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Customer Gagal Dihapus',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Customer' . $id_customer . 'Berhasil Dihapus',
            'data' => []
        ], 200);
    }

}
