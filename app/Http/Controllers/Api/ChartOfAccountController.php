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
                'message' => 'data gagal dipanggil',
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

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{

        }catch(\Exception $e){
            return response()->json([

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

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
    }
}
