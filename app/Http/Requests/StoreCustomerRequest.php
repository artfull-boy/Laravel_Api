<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();
        return $user != null && $user->tokenCan("create");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|email",
            "type" => ["required", Rule::in(["B", "I", "b", "i"])],
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "postalCode" => "required"
        ];


    }
    protected function prepareForValidation() {
        $this->merge([
            "postal_code"=>$this->postalCode
        ]);
    }
}
