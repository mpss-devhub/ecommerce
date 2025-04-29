<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallbackRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "respCode" => "string|required",
            "respMsg" => "string|required",
            "data" => "string|required"
        ];
    }
}
