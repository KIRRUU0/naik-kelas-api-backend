<?php

namespace App\Http\Controllers;

use App\Models\LayananUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayananUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layananUmum = LayananUmum::all();
        return response()->json([
        "message" => "Data layanan umum berhasil diambil",
        "data" => $layananUmum
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_layanan' => 'required',
            'deskripsi' => 'required',
            'highlight' => 'required',
            'url_cta' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $layananUmum = LayananUmum::create($request->all());
        return response()->json([
            "message" => "Data layanan umum berhasil ditambahkan",
            "data" => $layananUmum
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LayananUmum $layananUmum)
    {
        $layananUmum = LayananUmum::find($layananUmum->id);

        if (is_null($layananUmum)) {
            return response()->json([
                "message" => "Data layanan umum tidak ditemukan"
            ], 404);
        }
        return response()->json([
            "message" => "Data layanan umum berhasil diambil",
            "data" => $layananUmum
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LayananUmum $layananUmum)
    {
        $validator = Validator::make($request->all(), [
            'judul_layanan' => 'required',
            'deskripsi' => 'required',
            'highlight' => 'required',
            'url_cta' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $layananUmum = LayananUmum::find($layananUmum->id);
        if (is_null($layananUmum)) {
            return response()->json([
                "message" => "Data layanan umum tidak ditemukan"
            ], 404);
        }

        $layananUmum->update($request->all());
        return response()->json([
            "message" => "Data layanan umum berhasil diupdate",
            "data" => $layananUmum
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LayananUmum $layananUmum)
    {
        $layananUmum = LayananUmum::find($layananUmum->id);
        if (is_null($layananUmum)) {
            return response()->json([
                "message" => "Data layanan umum tidak ditemukan"
            ], 404);
        }
        $layananUmum->delete();
        return response()->json([
            "message" => "Data layanan umum berhasil dihapus"
        ], 200);
    }
}
