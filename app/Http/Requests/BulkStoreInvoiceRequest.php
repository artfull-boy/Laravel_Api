<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
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
            "*.customerId" => ["required","integer"],
            "*.amount" => ["required","numeric"],
            "*.status" => ["required", Rule::in(["billed", "paid", "void"])],
            "*.billedDate" => ["required","date_format:Y-m-d H:i:s"],
            "*.paidTime" => ["date_format:Y-m-d H:i:s", "nullable"],
        ];


    }
    protected function prepareForValidation() {
       $data = [];

       foreach($this->toArray() as $elem) {
        $elem["customer_id"] = $elem["customerId"] ?? null;
        $elem["billed_dated"] = $elem["billedDate"] ?? null;
        $elem["paid_time"] = $elem["paidTime"] ?? null;

        $data[] = $elem;
       }

       $this->merge($data);
    }
}
