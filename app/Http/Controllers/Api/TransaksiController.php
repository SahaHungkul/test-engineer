<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Http\Requests\Store\StoreTransaksiRequest;
use App\Http\Resources\TransaksiResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $transaksi = Transaksi::all();
            return response()->json([
                'status' => true,
                'message' => 'data Transaksi berhasil diambil',
                'data' => TransaksiResource::collection($transaksi),
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
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request)
{
    return DB::transaction(function () use ($request) {
        $transaksi = Transaksi::create($request->validated());

        if (!$request->validated()) {
            throw new \Exception('Data tidak valid');
        }

        if (!$transaksi->coa_id) {
            throw new \Exception('COA ID tidak tersimpan atau tidak valid');
        }

        return response()->json([
            'status' => true,
            'message' => 'Transaksi telah berhasil',
            'data' => new TransaksiResource($transaksi),
        ], 200);
    });
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $transaksi = Transaksi::find($id);

            if (!$transaksi) {
                return response()->json([
                    'status' => false,
                    'message' => 'data tidak di temukan',
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Transaksi berhasil di ambil',
                'data' => new TransaksiResource($transaksi),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'gagal mengambil data',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $transaksi = Transaksi::find($id);

            if (!$transaksi) {
                return response()->json([
                    'status' => false,
                    'message' => 'data tidak di temukan',
                ], 404);
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'data transaksi berhasil di hapus'
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
