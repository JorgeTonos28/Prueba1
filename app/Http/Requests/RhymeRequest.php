<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RhymeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'word' => ['required', 'string', 'alpha', 'min:2', 'max:30'],
        ];
    }
}
