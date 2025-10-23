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
            'coa' => [
                'id' => $this->chart_of_account->id,
                'kode' => $this->chart_of_account->kode,
                'nama' => $this->chart_of_account->nama,
            ],
            'deskripsi' => $this->deskripsi,
            'debit' => $this->debit,
            'kredit' => $this->kredit,
        ];
    }
}
