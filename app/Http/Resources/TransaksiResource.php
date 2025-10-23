<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'coa' => $this->coa ? [
                'id' => $this->coa->id,
                'kode' => $this->coa->kode,
                'nama' => $this->coa->nama,
            ] : null,
            'deskripsi' => $this->deskripsi,
            'debit' => $this->debit,
            'kredit' => $this->kredit,
        ];
    }
}
