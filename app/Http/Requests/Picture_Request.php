<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Picture_Request extends FormRequest
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
            'take_time' => 'required|date',
            'field_id' => 'required|integer',
            'post_img' => 'required|array',
            'post_img.*' => 'image|mimes:jpeg,jpg,png,gif',
            'remarks' => 'string',
        ];
    }
    public function messages(){
        return [
            "image" => "画像ファイルを入れて下さい。",
        ];
    }
}
