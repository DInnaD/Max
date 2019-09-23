<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
    public function rules()//only store update
    {
        
        return [
            'title'  =>  'required|min:1|max:32|string', 
            'country' => 'min:1|max:32|string',
            'city' => 'min:1|max:32|string',
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title'  =>  'Position Name', 
            'country' => 'Position Country',
            'city' => 'Position City',           
        ];
    }

    
    
    
}
