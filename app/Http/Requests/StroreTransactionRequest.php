<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StroreTransactionRequest extends FormRequest
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
            'city_id' => 'required|exists:cities,id',
            'contact_method_id' => 'required|exists:contact_methods,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'transaction_type_id' => 'required|exists:transaction_types,id',

            'cost' => 'required|numeric|min:0',
            'description' => 'sometimes|nullable|string|max:500',
            'contact_info' => 'required|string|max:20',
            'property_area' => 'required|numeric',
            'property_rooms' => 'sometimes|nullable|numeric',
            'property_status' => 'required',
            'property_address' => 'required|string|max:225',
            'transaction_status' => 'in:معلقة,قيد الانجاز,منجزة,مرفوضة',
            'required_documents.*' => 'sometimes|nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx|max:5120',
            'property_images.*' => 'sometimes|nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120',

            'stripeToken' => 'required|string',
            'amount' => 'required|numeric|min:3',
            'user_id' => 'exists:users,id'
        ];
    }
}
