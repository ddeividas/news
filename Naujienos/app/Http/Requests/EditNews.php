<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditNews extends FormRequest
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
    public function messages()
    {
        return [
            'required' => 'Užpildykite laukus',
            'title.min' => 'Minimalus simboliu skaicius: 10',
            'photo.mimes' => 'Netinkamas nuotraukos formatas',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:10'],
            'text' => 'required',
            'category_id' => 'required',
            'photo' => 'mimes:jpeg,bmp,png',
        ];
    }
}

