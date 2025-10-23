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
        'coa_id',
        'deskripsi',
        'debit',
        'kredit',
    ];
    protected $casts = [
        'debit' => 'decimal:2',
        'kredit' => 'decimal:2',
    ];
    public function coa()
    {
        return $this->belongsTo(ChartOfAccount::class,'coa_id', 'id');
    }
}
