<?php

namespace App\Http\Requests;

class StoreUrlRequest extends JsonFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'url' => 'required|url'
        ];
    }
}
