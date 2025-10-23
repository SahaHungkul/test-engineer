<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal' => 'required|date',
            'coa_id' => 'required|exists:chart_of_accounts,id',
            'deskripsi' => 'nullable|string',
            'debit' => [
                'required',
                'numeric',
                'regex:/^\d{1,13}(\.\d{1,2})?$/'
            ],
            'kredit' => [
                'required',
                'numeric',
                'regex:/^\d{1,13}(\.\d{1,2})?$/'
            ],
        ];
    }
}
