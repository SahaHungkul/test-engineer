<?php

namespace App\Http\Requests\Update;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoaRequest extends FormRequest
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
            'kode' => [
                'sometimes',
                'integer',
                Rule::unique('chart_of_accounts', 'kode')->ignore(request()->route('id')),
            ],
            // 'kode' => 'sometimes|integer|unique:chart_of_accounts,kode',
            'nama' => 'sometimes|string|max:255',
            'kategori_id' => 'sometimes|exists:kategoris,id'
        ];
    }
}
