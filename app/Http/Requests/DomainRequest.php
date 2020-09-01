<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainRequest extends FormRequest
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
            'domain.name' => 'required|min:10|max:20|active_url'
        ];
    }

    public function messages()
    {
        return [
            'domain.name.required' => 'Not a valid url',
        ];
    }
}