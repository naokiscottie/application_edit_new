<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'field_name' => 'required|max:30|string',
            'field_address' => 'required|max:30|string',
            'power' => 'required|numeric',
            'solar_power' => 'required|numeric',
            'contract_date' => 'required|max:20|date',
            'contract_money' => 'required|integer',
            'customer_id' => 'required|integer',
        ];
    }
}
