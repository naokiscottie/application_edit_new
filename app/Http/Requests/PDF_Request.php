<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PDF_Request extends FormRequest
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

            'document_name' => 'required|string',
            'field_id' => 'required|integer',
            'document_id' => 'required|integer',
            'post_pdf' => 'required|array',
            'post_pdf.*' => 'required|mimes:pdf',

        ];

    }


    public function attributes(){
        return [
            'post_pdf.*' => '資料の選択',
            'document_name' => '書類名',
            'field_id' => '案件名',
            'document_id' => '資料の種類',
            'post_pdf' => '資料の選択',
        ];
    }

}
