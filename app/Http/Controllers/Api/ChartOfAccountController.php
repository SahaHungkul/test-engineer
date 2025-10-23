<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreChartOfAccountRequest;
use App\Http\Requests\Update\UpdateCoaRequest;
use App\Http\Resources\ChartOfAccountResource;
use Illuminate\Support\Facades\DB;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;

class ChartOfAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $coa = ChartOfAccount::all();

            return response()->json([
                'status' => true,
                'data' => new ChartOfAccountResource($coa)
            ]);
        }catch(\Exception $e){
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
    public function store(StoreChartOfAccountRequest $request)
    {
        try{
            DB::beginTransaction();
            $coa = ChartOfAccount::create($request->validated());

            DB::commit();
            return response()->json([
                'status' => true,
                'data' => new ChartOfAccountResource($coa),
            ]);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'gagal menambahkan data',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $coa = ChartOfAccount::find($id);

            if(!$coa){
                return response()->json([
                    'status' => false,
                    'message' => 'data tidak di temukan'
                ],404);
            }

            return response()->json([
                'status' => true,
                'data' => new ChartOfAccountResource($coa),
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'galgal memanggil data',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoaRequest $request, string $id)
    {
        try{
            DB::beginTransaction();
            $coa = ChartOfAccount::find($id);

            if(!$coa){
                return response()->json([
                    'status' => false,
                    'message' => 'data tidak di temukan'
                ],404);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'data' => new ChartOfAccountResource($coa),
            ]);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'gagal memperbarui data',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();
            $coa = ChartOfAccount::find($id);

            if(!$coa){
                return response()->json([
                    'status' => false,
                    'message' => 'data tidak di temukan'
                ],404);
            }
            $coa->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'data' => new ChartOfAccountResource($coa),
            ]);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'gagal menghapus data',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
