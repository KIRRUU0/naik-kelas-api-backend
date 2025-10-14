<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; //untuk enkripsi password

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $users_safe = $users->map(function($user) {
            return $user->makeHidden(['password']);
        });
        return response()->json([
            "message" => "Data pengguna berhasil diambil",
            "data" => $users_safe
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // HASHING
        ]);

        return response()->json([
            'message' => 'Data pengguna berhasil ditambahkan',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $id)
    {
        $user = User::find($id->id);

        if (is_null($user)) {
            return response()->json([
                "message" => "Data pengguna tidak ditemukan"
            ], 404);
        }
        return response()->json([
            "message" => "Data pengguna berhasil diambil",
            "data" => $user->makeHidden(['password'])
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $id)
    {
        $user = User::find($id->id);
        if (is_null($user)) {
            return response()->json([
                "message" => "Data pengguna tidak ditemukan"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]); //enkripsi password
        }

        $user->update($request->all());

        return response()->json([
            "message" => "Data pengguna berhasil diupdate",
            "data" => $user->makeHidden(['password'])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                "message" => "Data pengguna tidak ditemukan"
            ], 404);
        }
        $user->delete();
        return response()->json([
            "message" => "Data pengguna berhasil dihapus"
        ], 200);
    }
}
