<?php

namespace App\Http\Controllers\Api;

use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function exportTransaksi(){
        return Excel::download(new LaporanExport,'profit/loss.xlsx');
    }
    public function laporan(){
        $data = Transaksi::with('coa')
        ->orderBy('tanggal','asc')
        ->get()
        ->map(function ($t){
            return [
                    'tanggal' => $t->tanggal,
                    'kode_akun' => $t->coa->kode,
                    'nama_akun' => $t->coa->nama,
                    'deskripsi' => $t->deskripsi,
                    'debit' => $t->debit,
                    'kredit' => $t->kredit,
            ];
        });

        return response()->json([
            'status'=> true,
            'data' => $data,
        ],200);
    }
}
