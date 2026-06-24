<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PartnershipInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'category' => ['required', Rule::in(['buah', 'sayur', 'daging', 'sembako', 'lainnya'])],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ];
    }
}
