<?php

namespace App\Http\Requests\Dashboard\Gateway;

use Illuminate\Foundation\Http\FormRequest;

class StoreGatewayRequest extends FormRequest
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
            'name' => ['required','min:1','max:255'],
            'allowed_ips' => ['nullable'],
            'min_settlement' => ['required'],
            'fee_method' => ['required','in:0,1'],
            'settlement_address' => ['required']
        ];
    }
}
