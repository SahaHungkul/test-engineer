<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreKategoriRequest;
use App\Http\Requests\Update\UpdateKategoriRequest;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kategori = Kategori::all();

            return response()->json([
                'status' => true,
                'data' => KategoriResource::collection($kategori),
            ],201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage(),
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriRequest $request)
    {
        try {
            DB::beginTransaction();

            $kategori = Kategori::create($request->validated());

            DB::commit();
            return response()->json([
                'status' => true,
                'data' => new KategoriResource($kategori),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'gagal menambahkan Kategori',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $kategori = Kategori::find($id);
            if (!$kategori) {
                return response()->json([
                    'status' => false,
                    'message' => 'kategori tidak di temukan',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => new KategoriResource($kategori)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'gagal memanggil data',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $kategori = Kategori::find($id);
            if (!$kategori) {
                return response()->json([
                    'status' => false,
                    'message' => 'kategori tidak di temukan',

                ], 404);
            }

            $kategori->update($request->validated());

            DB::commit();
            return response()->json([
                'status' => true,
                'data' => new KategoriResource($kategori),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'gagal update kaktegori',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $kategori = Kategori::find($id);
            if (!$kategori) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kategori tidak ditemukan'
                ], 404);
            }
            $kategori->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'gagal menghapus data',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
