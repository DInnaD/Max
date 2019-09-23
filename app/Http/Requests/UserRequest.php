<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()//only update
    {
    
        return [
            'email' =>  'required|email|unique:users|string',
            'password'  =>  'required|string|min:6|max:20',
            'first_name'  =>  'min:1|max:20|string',
            'last_name' => 'min:1|max:40|string',
            'country' => 'min:1|max:100|string',
            'city' => 'min:1|max:100|string',
            'phone' => 'min:1|max:30|string',
            'role' => 'min:1|max:20|string',//pivot
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
            'email' =>  'User Email',
            'password'  =>  'User Password',
            'first_name'  =>  'User Name',
            'last_name' => 'User Surname',
            'country' => 'User Country',
            'city' => 'User City',
            'phone' => 'User Phone Number',
            'role' => 'User Role',//pivot
            
        ];
    }

  
}
