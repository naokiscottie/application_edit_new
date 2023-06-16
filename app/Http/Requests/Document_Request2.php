<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Document_Request2 extends FormRequest
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
            'id' => 'required',
            'document_name' => 'required|max:40',
            'remarks' => 'required|max:10000',

        ];
    }
}
