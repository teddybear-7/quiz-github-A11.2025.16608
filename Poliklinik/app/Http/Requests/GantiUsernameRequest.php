<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GantiUsernameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Username wajib diisi.',
            'nama.max'      => 'Username maksimal 255 karakter.',
        ];
    }
}
