<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'field_id' => 'required|integer',
            'year_checking' => 'required|integer',
            'panel_checking' => 'required|integer',
            'panel_measurement' => 'required|integer',
            'month_period' => 'required|integer',
            'year' => 'required|numeric|between:2022,2040',
            'start_month' => 'required|integer|between:1,12',
        ];
    }

}
