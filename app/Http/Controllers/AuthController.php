<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class AuthController extends Controller
{

    public function indexLogin()
    {
        return view("v_login");
    }
    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            session(['user_role' => $role]);

            if ($role === 'admin' || $role === 'Admin') {
                return redirect()->route('admin');
            } elseif ($role === 'sales' || $role === 'Sales') {
                return redirect()->route('customer');
            }

        } else {
            return back()->with('loginError', 'NIP dan Password Anda Salah!!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function getRoleSales()
    {
        $user = User::where('role', 'Sales')->get();
        return response()->json([
            'status' => true,
            'message' => 'All Data User Sales',
            'data' => $user
        ], 200);
    }
    public function storeSales(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'password' => 'required'
        ]);

        try {
            $user = User::create([
                'role' => 'Sales',
                'nip' => $request->nip,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
            ]);
            event(new Registered($user));
            Auth::login($user);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Sales Gagal Ditambahkan',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sales Berhasil Ditambahkan',
            'data' => $user
        ], 200);
    }

    public function updateSales(Request $request, $id)
    {
        $user = User::findOrFail($id);
        try {
            $user->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Sales Gagal Diubah',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sales Berhasil Diubah',
            'data' => $user
        ], 200);
    }

    public function deleteSales($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Sales Gagal Dihapus',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sales Berhasil Dihapus',
            'data' => $user->id
        ], 200);
    }
}
