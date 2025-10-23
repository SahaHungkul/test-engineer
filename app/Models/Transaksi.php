<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $fillable = [
        'tanggal',
        'deskripsi',
        'debit',
        'kredit',
    ];

    public function coa()
    {
        return $this->belongsTo(ChartOfAccount::class,'coa_id', 'id');
    }
}
